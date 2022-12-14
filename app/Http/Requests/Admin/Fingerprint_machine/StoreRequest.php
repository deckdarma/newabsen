<?php

namespace App\Http\Requests\Admin\Fingerprint_machine;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
         'ip' => 'required',
            'dinas' => 'required',
            'comkey' => 'required',
            'company_id' => 'required',
            'shift' => 'required',
            'idshift' => 'required',
            'status' => 'required'
			
        ];
    }

    public function messages()
    {
       return [

            'ip.required' => 'IP Wajib Disi',
            'dinas.required' => 'Nama Mesin Wajib Disi',
            'company_id.required' => 'Pilih OPD Terlebih dahulu',
            'status.required' => 'Status Wajib Disi',
            'shift.required' => 'Pilih Opd Normal/Opd Shift',
            'idshift.required' => 'Pilih Status Shift',
            'comkey.required' => 'Comkey Wajib Disi',
         
			
        ];
    }
}
