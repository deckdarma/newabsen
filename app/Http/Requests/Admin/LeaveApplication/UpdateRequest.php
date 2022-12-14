<?php

namespace App\Http\Requests\Admin\LeaveApplication;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = Reply::failedToastr($validator);
        throw new HttpResponseException(response()->json($response, 200));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'leaveType' => 'required|unique:leave_applications,leaveType,'.$this->leavetype.',id,company_id,'.$this->companyId,
         'employee_id'=>'required',
            'reason'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ];
    }
	
		    public function messages()
    {
        return [
                   'employee_id.required' => 'Pilih Nama Pegawai',
            'start_date.required' => 'Tentukan Tanggal Mulai',
            'reason.required' => 'Ketik Alasan',
            'leaveType.required' => 'Pilih Keterangan',
            'end_date.required' => 'Tentukan Tanggal Akhir'
        ];
    }
}
