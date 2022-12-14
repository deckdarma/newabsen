<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Salary\StoreRequest;
use App\Models\Employee;
use App\Models\Salary;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class SalaryController extends AdminBaseController
{

    public function store(StoreRequest $request)
    {
        $input = $request->all();

        $salary = Salary::create($input);

        $viewData = '';
        return Reply::successWithData( 'Salary Created successfully',['viewData' => $viewData]);

    }


    public function update($id)
    {
        //
    }

    public function addSalaryModal($id)
    {
        $this->employeesActive = 'active';
        $this->employee_id = $id;

       $this->pegdata = Employee::find($id);
        return View::make('admin.employees.show_salary_modal', $this->data);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        Salary::destroy($id);
        return Reply::success('messages.deleteSuccess');
    }

}
