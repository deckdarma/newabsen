<?php

namespace App\Http\Requests\Admin\DataPemimpin;

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
            'idpemimpin' => 'required',
            'namajabatan'=>'required'
        ];
    }
	    public function messages()
    {
        return [
                   'idpemimpin.required' => 'Pilih Nama Pegawai'
        ];
    }
}
