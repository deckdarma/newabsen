<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Files;
use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Bank_detail;
use App\Models\Department;
use App\Models\Golonganpeg;

use App\Models\Designation;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Company;

use App\Models\Employee_document;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests;
use App\Http\Requests\Admin\MutasiMasuk\StoreRequest;
use App\Http\Requests\Admin\MutasiMasuk\EditRequest;
use App\Http\Requests\Admin\MutasiMasuk\UpdateRequest;
use App\Http\Requests\Admin\MutasiMasuk\UploadRequest;


/**
 * Class EmployeesController
 * This Controller is for the all the related function applied on employees
 */
class MutasiMasukController extends AdminBaseController
{

    public static $MAX_EMPLOYEES = 100;

    /**
     * Constructor for the Employees
     */

    public function __construct()
    {
        parent::__construct();

        $this->employeesOpen = 'active open';
        $this->MutasiActive = 'active';
        $this->pageTitle = trans('pages.employees.title');
    }


    public function index()
    {
     $this->pageTitle = "Mutasi Masuk";

        $this->tasks = Employee::orderBy('order','ASC')
		->join('companies', 'employees.darimutasi', '=', 'companies.id')
		->select('employees.id','employees.darimutasi','employees.full_name','employees.status','companies.company_name','employees.statusmupeg','employees.designation')
			->where('designation', '=', NULL)
			->where('mutasi', '=', 1)
			->where('company_id', '=', $this->company_id)
			->orderBy('statusmupeg', 'asc')

		->get();
		
        return View::make('admin.mutasimasuk.index', $this->data);
    }
	



	
	
	
	
	
	



 

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->pageTitle = trans('pages.employees.editTitle');

   $this->MutasiActive = 'active';

        $this->department = Department::pluck('name', 'department.id as id');
        $this->departmentno = Department::all();
        $this->employee = Employee::find($id);

        $this->designation = Designation::find($this->employee->designation);
        $this->golonganpeg = Golonganpeg::get();


        $doc = [];

        foreach ($this->employee->documents as $documents) {
            $doc[$documents->type] = $documents->document_url;
        }

        $this->documents = $doc;

        return View::make('admin.mutasimasuk.edit', $this->data);
    }
    public function create()
    {
        $this->pageTitle = trans('pages.employees.createTitle');
        $this->employeesActive = 'active';
        $this->department = Department::select('department.id as id', 'name')
            ->company($this->company_id)
            ->manager(admin()->id)
            ->pluck('name', 'department.id');
     $this->golonganpeg = Golonganpeg::get();
        $this->data["pageTitle"] = trans("core.btnAddEmployee");

        // Check logged in user can create employee according to this currecnt plan
        $this->checkCanCreateEmployee();

        return View::make('admin.mutasimasuk.create', $this->data);
    }

 
    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id)
    {
        // Check employee Company
        $employee = Employee::find($id);

 

        if ($request->updateType == 'company') {
            $companyDetails = $employee;

            $companyDetails->employeeID = $request->employeeID;
            $companyDetails->designation = $request->designation;
            $companyDetails->joining_date = $request->joining_date;
            $companyDetails->annual_leave = $request->annual_leave;
			$companyDetails->statusmupeg = $request->statusmupeg;
            $companyDetails->golongan = $request->golongan;
            $companyDetails->firstphl = $request->firstphl;
            $companyDetails->mutasi = $request->mutasi;
            $companyDetails->darimutasi = $request->darimutasi;
            $companyDetails->company_id = $request->company_id;
            $companyDetails->shift = $request->shift;
 
            $companyDetails->exit_date = (trim($request->exit_date) != '') ? date('Y-m-d', strtotime($request->exit_date)) : null;

            $companyDetails->status = ($request->status != 'active') ? 'inactive' : 'active';


		   $companyDetails->save();

            if (isset($request->salary)) {
                foreach ($request->salary as $index => $value) {
                    $salaryDetails = Salary::find($index);
                    $salaryDetails->type = $request->type[$index];
                    $salaryDetails->salary = $value;
                    $salaryDetails->save();
                }
            }
	
	     


         return Reply::success('Berhasil Mutasi Masuk');

        }

    
      


    }


 

    /**
     * Remove the specified employee from storage.
     */

    public function destroy(Requests\Admin\Employee\DeleteRequest $request,$id)
    {

        Employee::destroy($id);

        return Reply::success("messages.successDelete");
    }



    public function importUpload(UploadRequest $request)
    {

        $filename = $this->data["active_company"]->id . "_" . time() . ".csv";
        $path = storage_path() . "/csvuploads";

        $request->file("file")->move($path, $filename);
        session(['importFilePath'=>$path]);
        session(['importFileName'=> $filename]);


        return [
            "status" => "success",
            "message" => "File upload successful",
            "action" => "redirect",
            "url" => route("admin.mutasimasuk.match")
        ];
    }

    public function match()
    {
        $path = session("importFilePath");
        $filename = session("importFileName");

        if ($path == "" || $path == null) {
            \App::abort("500");
        }

        $result = $this->csvDataForFilter($path . "/" . $filename);

        if ($result["count"] > EmployeesController::$MAX_EMPLOYEES + 1) {
            $this->data["message"] = "You are not allowed to import more than " . EmployeesController::$MAX_EMPLOYEES . " employees at a time";
            return view("admin.errors.error", $this->data);
        }

        $this->data = array_merge($this->data, $result);

        return view("admin.mutasimasuk.match", $this->data);
    }

    private function csvDataForFilter($filePath)
    {
        $csvFields = [];
        $csvHeadingFields = [];

        // IF you make a change here, also change in importProcess function
        $leadFields = [["id" => "static-1", "name" => "Name", "required" => "Yes"],
            ["id" => "static-2", "name" => "Father's Name", "required" => "No"],
            ["id" => "static-3", "name" => "Date of Birth", "required" => "No"],
            ["id" => "static-4", "name" => "Gender", "required" => "Yes"],
            ["id" => "static-5", "name" => "Phone", "required" => "No"],
            ["id" => "static-6", "name" => "Local Address", "required" => "No"],
            ["id" => "static-7", "name" => "Permanent Address", "required" => "No"],
            ["id" => "static-8", "name" => "Email", "required" => "Yes"],
            ["id" => "static-9", "name" => "Employee ID", "required" => "Yes"],
            ["id" => "static-10", "name" => "Department", "required" => "Yes"],
            ["id" => "static-11", "name" => "Designation", "required" => "Yes"],
            ["id" => "static-12", "name" => "Credit Leaves", "required" => "No"],
            ["id" => "static-13", "name" => "Date of Joining", "required" => "No"],
            ["id" => "static-14", "name" => "Basic Salary", "required" => "No"],
            ["id" => "static-15", "name" => "Hourly Rate", "required" => "No"],
            ["id" => "static-16", "name" => "Account Holder Name", "required" => "No"],
            ["id" => "static-17", "name" => "Account Number", "required" => "No"],
            ["id" => "static-18", "name" => "Bank Name", "required" => "No"],
            ["id" => "static-19", "name" => "Bank Identifier Code", "required" => "No"],
            ["id" => "static-20", "name" => "Branch Location", "required" => "No"],
            ["id" => "static-21", "name" => "Tax Payer ID", "required" => "No"]];

        $formColumnDetailsByID = [];

        foreach ($leadFields as $leadField) {
            $formColumnDetailsByID[$leadField["id"]] = $leadField["name"];
        }

        $delimiter = ",";

        // Opening file for Reading and fetching Data
        $file = fopen($filePath, "r");

        $count = 1;
        while (!feof($file)) {

            if ($count < 6) {
                if ($delimiter == "\t") {
                    $line = fgets($file);
                    $words = explode("\t", $line);
                    $finalLine = "";
                    foreach ($words as $word) {
                        $finalLine = $finalLine . (($finalLine == "") ? "" : ",") . "\"" . addslashes($word) . "\"";
                    }
                    $newRows = str_getcsv($finalLine);
                } else {
                    $newRows = fgetcsv($file);
                }

                if (!empty($newRows)) {
                    if ($count == 1) {
                        foreach ($newRows as $key => $value) {
                            $csvHeadingFields[$key] = $value;
                        }
                    } else {
                        foreach ($newRows as $key => $value) {
                            $csvFields[$key][] = $value;
                        }
                    }
                }
            }

            if ($count >= EmployeesController::$MAX_EMPLOYEES + 1) {
                break;
            }

            $count++;
        }
        fclose($file);

        $matchedColumns = array_fill(0, count($csvHeadingFields), false);
        $matchedColumnsDetail = array_fill(0, count($csvHeadingFields), -1);
        $matchCount = 0;
        $leadMatchedColumns = [];

        foreach ($csvHeadingFields as $key => $value) {
            $currentCsvHeadingField = strtolower(str_replace([' ',
                '_'], '', trim($value)));

            foreach ($leadFields as $leadField) {
                $currentFromColumnField = strtolower(str_replace([' ',
                    '_'], '', trim($leadField["name"])));

                if ($currentCsvHeadingField == $currentFromColumnField) {
                    $matchedColumns[$key] = true;
                    $matchedColumnsDetail[$key] = $leadField['id'];
                    $leadMatchedColumns[$leadField['id']] = 1;
                    $matchCount++;
                    break;
                }
            }
        }

        $result = [];
        $result['csvFields'] = $csvFields;
        $result['csvHeadingFields'] = $csvHeadingFields;
        $result['leadFields'] = $leadFields;
        $result['formColumnDetailsByID'] = $formColumnDetailsByID;
        $result['matchedColumns'] = $matchedColumns;
        $result['unmatchCount'] = count($leadFields) - $matchCount;
        $result['matchedColumnsDetail'] = $matchedColumnsDetail;
        $result['matchCount'] = $matchCount;
        $result['leadMatchedColumns'] = $leadMatchedColumns;
        $result['count'] = $count;

        return $result;
    }

    public function importProcess()
    {
        set_time_limit(0);

        $leadFields = [["id" => "static-1", "name" => "Name", "required" => "Yes"],
            ["id" => "static-2", "name" => "Father's Name", "required" => "No"],
            ["id" => "static-3", "name" => "Date of Birth", "required" => "No"],
            ["id" => "static-4", "name" => "Gender", "required" => "Yes"],
            ["id" => "static-5", "name" => "Phone", "required" => "No"],
            ["id" => "static-6", "name" => "Local Address", "required" => "No"],
            ["id" => "static-7", "name" => "Permanent Address", "required" => "No"],
            ["id" => "static-8", "name" => "Email", "required" => "Yes"],
            ["id" => "static-9", "name" => "Employee ID", "required" => "Yes"],
            ["id" => "static-10", "name" => "Department", "required" => "Yes"],
            ["id" => "static-11", "name" => "Designation", "required" => "Yes"],
            ["id" => "static-12", "name" => "Credit Leaves", "required" => "No"],
            ["id" => "static-13", "name" => "Date of Joining", "required" => "No"],
            ["id" => "static-14", "name" => "Basic Salary", "required" => "Yes"],
            ["id" => "static-15", "name" => "Hourly Rate", "required" => "Yes"],
            ["id" => "static-16", "name" => "Account Holder Name", "required" => "No"],
            ["id" => "static-17", "name" => "Account Number", "required" => "No"],
            ["id" => "static-18", "name" => "Bank Name", "required" => "No"],
            ["id" => "static-19", "name" => "Bank Identifier Code", "required" => "No"],
            ["id" => "static-20", "name" => "Branch Location", "required" => "No"],
            ["id" => "static-21", "name" => "Tax Payer ID", "required" => "No"]];

        $formColumnDetailsByID = [];

        foreach ($leadFields as $leadField) {
            $formColumnDetailsByID[$leadField["id"]] = $leadField["name"];
        }

        //            $company_id = $this->data["company_id"];

        $date = new \DateTime();
        \Session::put('step4StartingTime', $date);

        $mapping = request()->get("sorting");

        //Getting Csv File and campaignID From Session Variable

        $filePath = \Session::get('importFilePath');
        $filename = \Session::get('importFileName');

        // Key to store progress in cache
        $cacheKey = "importProgress" . admin()->id;
        $expire = Carbon::now()->addMinutes(360);
        \Cache::put($cacheKey, "0", $expire);

        $duplicates = 0;
        if (!empty($filePath)) {
            //Array From Step 3
            $mappingArray = json_decode($mapping, false);

            // We flip array so that we can get which csv column is mapped to given field id
            $mappingFieldArray = array_flip($mappingArray);

            // Fill in remaining fields

            foreach ($leadFields as $leadField) {
                if (!isset($mappingFieldArray[$leadField["id"]])) {
                    $mappingFieldArray[$leadField["id"]] = -1;
                }
            }

            //                //Array Store FormsID which are not selected
            //                $remainingMappingArray = [];
            //                $doneMappingArray = [];
            //
            //                $formColumns = $leadFields;
            //
            //                foreach ($formColumns as $formColumn) {
            //                    if (in_array($formColumn["id"], $mappingArray) == false) {
            //                        $remainingMappingArray[ $formColumn->id ] = $formColumn->fieldName;
            //                    }
            //                    else {
            //                        $doneMappingArray[] = $formColumn->id;
            //                    }
            //                }
            //
            //                $csvOrTsvIndicator = substr($filePath, strrpos($filePath, "/") + 1, 1);

            $delimiter = ",";

            //Opening file for Reading and fetching Data
            $file = fopen($filePath . "/" . $filename, "r");

            // We measure progress as number of bytes processed
            $fileBytes = filesize($filePath . "/" . $filename);

            $count = 1;
            $totalLeadCustomDataAdded = 0;

            \DB::beginTransaction();

            $failedRecords = [];
            $csvHeading = [];

            try {
                while (!feof($file)) {
                    $newRows = fgetcsv($file, 0, $delimiter);

                    if (!empty($newRows) && $count > 1) {

                        try {
                            // Array which store those field which may be inserted
                            $newInsertedDataArray = [];
                            $newRows[-1] = "";

                            // Create a new employee or update existing employee
                            // TODO: Add option in front end to choose if yo update existing update
                            $employeeID = $this->data["company_id"] . "-" . trim($newRows[$mappingFieldArray["static-9"]]);

                            $employee = Employee::where("employeeID", $employeeID)->first();
                            $employeeExists = true;

                            // Create new employee if not exist
                            if (!$employee) {
                                $employee = new Employee();
                                $employeeExists = false;
                            }

                            $employee->employeeID = $employeeID;
                            $employee->company_id = $this->data["company_id"];
                            $employee->full_name = trim($newRows[$mappingFieldArray["static-1"]]);

                            $email = trim($newRows[$mappingFieldArray["static-8"]]);

                            // Update email if not same and create new password
                            if ($email != $employee->email) {
                                $employee->email = trim($newRows[$mappingFieldArray["static-8"]]);

                                // Insert new password
                                $newPassword = str_random(8);
                                $employee->password = "123456";
                            }


                            $employee->gender = strtolower(trim($newRows[$mappingFieldArray["static-4"]]));
                            $employee->father_name = trim($newRows[$mappingFieldArray["static-2"]]);
                            $employee->mobile_number = trim($newRows[$mappingFieldArray["static-5"]]);
                            $employee->date_of_birth = Carbon::parse($newRows[$mappingFieldArray["static-3"]])
                                ->format("Y-m-d");

                            // Create department and designation if not exits
                            $department = trim($newRows[$mappingFieldArray["static-10"]]);

                            $existingDepartment = Department::company($this->data["company_id"])
                                ->where("name", $department)
                                ->first();

                            if (!$existingDepartment) {
                                // Create a new department with this name
                                $existingDepartment = new Department();
                                $existingDepartment->company_id = $this->data["company_id"];
                                $existingDepartment->name = $department;
                                $existingDepartment->save();
                            }

                            $designation = trim($newRows[$mappingFieldArray["static-11"]]);

                            $existingDesignation = Designation::where("department_id", $existingDepartment->id)
                                ->where("designation", $designation)
                                ->first();

                            if (!$existingDesignation) {
                                // Create new designation with this name
                                $existingDesignation = new Designation();
                                $existingDesignation->department_id = $existingDepartment->id;
                                $existingDesignation->designation = $designation;
                                $existingDesignation->save();
                            }

                            $employee->designation = $existingDesignation->id;
                            $employee->joining_date = trim($newRows[$mappingFieldArray["static-13"]]);
                            $employee->statusmupeg = trim($newRows[$mappingFieldArray["static-6"]]);
                            $employee->permanent_address = trim($newRows[$mappingFieldArray["static-7"]]);
                            $employee->annual_leave = trim($newRows[$mappingFieldArray["static-12"]]);
                            $employee->status = "Active";

                            $employee->save();

//								if (!$employeeExists) {

                            // Queue sending email

//									$this->employee_name     = $employee->full_name;
//									$this->employee_email    = $employee->email;
//									$this->employee_password = $newPassword;
//									//---- PREPARE AND SEND EMAIL-----
//									$emailInfo = ['from_email'     => admin()->company->email,
//												  'from_name'      => admin()->company->name,
//												  'to'             => $employee->email,
//												  'active_company' => admin()->company];
//
//									$fieldValues = ['NAME'         => $employee->full_name,
//													'EMAIL'        => $employee->email,
//													'PASSWORD'     => $newPassword,
//													'COMPANY_NAME' => admin()->company->company_name];
//
//									EmailTemplate::prepareAndSendEmail('EMPLOYEE_ADD', $emailInfo, $fieldValues);
                            //---- PREPARE AND SEND EMAIL-----
//								}

                        } catch (\PDOException $e) {
                            $newRows["failReason"] = "Database Error";
                            unset($newRows[-1]);
                            $failedRecords[] = $newRows;

                            $data = @array_combine($csvHeading, $failedRecords);

                            \DB::table("failed_records")->insert([
                                "data" => json_encode($data, JSON_PRETTY_PRINT | JSON_PARTIAL_OUTPUT_ON_ERROR),
                                "fail_reason" => $e->getMessage()
                            ]);
                        } catch (\Exception $e) {
                            $newRows["failReason"] = $e->getMessage();
                            unset($newRows[-1]);
                            $failedRecords[] = $newRows;

                            $data = @array_combine($csvHeading, $failedRecords);

                            \DB::table("failed_records")->insert([
                                "data" => json_encode($data, JSON_PRETTY_PRINT | JSON_PARTIAL_OUTPUT_ON_ERROR),
                                "fail_reason" => $e->getMessage()
                            ]);
                        }
                    } else if (!empty($newRows)) {
                        $csvHeading = $newRows;
                        $csvHeading[] = "Fail Reason";
                    }

                    $count++;

                    $currentPosition = ftell($file);

                    $processingCompleted = ($currentPosition / $fileBytes) * 100;

                    \Cache::put($cacheKey, $processingCompleted, $expire);
                }
            } catch (\Exception $e) {
                \DB::rollBack();

                return \Response::make("Error importing data. No changes were made. Please contact support with error: " . $e->getMessage(), 500);
            }

            \DB::commit();

            fclose($file);
            \Session::put('failedRecords', $failedRecords);
            \Session::put('csvHeading', $csvHeading);
        }


        $data = [];
        $data['status'] = 'success';


        return json_encode($data);
    }


    public
    function checkImportProgress()
    {

        $cacheKey = "importProgress" . admin()->id;
        $processingCompleted = \Cache::get($cacheKey);

        return $processingCompleted;
    }

    public function cancelImport()
    {
        \File::delete(\Session::get("importFilePath") . "/" . \Session::get("importFileName"));
        \Session::remove("importFilePath");
        \Session::remove("importFileName");

        $cacheKey = "importProgress" . admin()->id;
        \Cache::forget($cacheKey);
    }

    public function failedRecords()
    {
        $failedRecords = \Session::get("failedRecords");
        $csvHeading = \Session::get("csvHeading");


        $this->data["failedRecords"] = $failedRecords;
        $this->data["csvHeading"] = $csvHeading;

        return view("admin.mutasimasuk.failed_records", $this->data);
    }

    public function downloadFailedRecords()
    {
        $failedRecords = \Session::get("failedRecords");
        $csvHeading = \Session::get("csvHeading");

        $path = storage_path() . "/csvuploads/failed_records_" . Carbon::now()->format("Y-m-d") . ".csv";

        $file = fopen($path, "w");

        fputcsv($file, $csvHeading);

        foreach ($failedRecords as $record) {
            fputcsv($file, $record);
        }

        fclose($file);

        return \Response::download($path);
    }

    public function checkCanCreateEmployee()
    {
        $currentTotalEmployee = Employee::manager(admin()->id)->count();
        $planTotalEmployee = admin()->company->subscriptionPlan->end_user_count;

        if ($currentTotalEmployee < $planTotalEmployee) {
            $this->canCreateEmployee = true;
        } else {
            $this->canCreateEmployee = false;
        }
    }
}
