<?php

namespace App\Http\Requests\Admin\LeaveApplication;

use App\Http\Requests\AdminCoreRequest;

class StoreRequest extends AdminCoreRequest
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


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'leaveType' => 'required|unique:leave_applications,leaveType,:id,id,company_id,'.$this->companyId,
         
            'employee_id'=>'required',
            'company_id'=>'required',
            'reason'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ];
    }
		    public function messages()
    {
        return [
           'employee_id.required' => 'Pilih Nama Pegawai',
           'company_id.required' => 'Pilih Nama OPD',
            'start_date.required' => 'Tentukan Tanggal Mulai',
            'reason.required' => 'Ketik Alasan',
            'leaveType.required' => 'Pilih Keterangan',
            'end_date.required' => 'Tentukan Tanggal Akhir'
        ];
    }
}
