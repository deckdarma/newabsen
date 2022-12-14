<?php

namespace App\Http\Requests\Admin\DataMutasi;

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
  

        if ($this->get('updateType') == 'company') {
       
		
            $rules['company_id'] = 'required';
        }

  



        return $rules;
    }
	
	    public function messages()
    {
        return [
            'company_id.required' => 'Silahkan Pilih OPD'
        ];
    }
}
