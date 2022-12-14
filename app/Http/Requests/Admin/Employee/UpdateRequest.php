<?php

namespace App\Http\Requests\Admin\Employee;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Employee;

use Illuminate\Validation\Rule;

class UpdateRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $employee = Employee::where('employeeID', $this->route('employee'));
        return admin() && $employee;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if ($this->get('updateType') == 'bank') {
            $rules['account_name'] = 'required';
            $rules['account_number'] = 'required';
            $rules['bank'] = 'required';
            $rules['bin'] = 'required';
            $rules['branch'] = 'required';
        }

        if ($this->get('updateType') == 'company') {
            $rules['employeeID'] = [
                'required',
                Rule::unique('employees')->where(function ($query) {
                    return $query->where('company_id', admin()->company_id);
                })->ignore($this->route('employee'), 'id')
            ];
            $rules['designation'] = 'required';
            $rules['golongan'] = 'required';
            $rules['shift'] = 'required';
        }

        if ($this->get('updateType') == 'personalInfo') {
            $rules['full_name'] = 'required';
         
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->route('employee'), 'id'),
            ];
            $rules['profile_image'] = 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:4000';
            $rules['father_name'] = 'required';
        }

        if ($this->get('updateType') == 'documents') {
            $rules['resume'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['offerLetter'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['joiningLetter'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['contract'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['IDProof'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000\'';
        }

        return $rules;
    }
	
		    public function messages()
    {
        return [
            'employeeID.integer' => 'NIP Tidak boleh ada spasi',
            'employeeID.required' => 'NIP Wajib Disi',
            'full_name.required' => 'Ketik Nama Lengkap',
            'shift.required' => 'Silahkan Pilih Shift',
            'employeeID.unique' => 'NIP Sudah ada, Harap Hubungi Super Admin',
            'email.unique' => 'Email Sudah Ada',
        ];
    }
}
