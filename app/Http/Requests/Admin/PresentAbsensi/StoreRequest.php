<?php

namespace App\Http\Requests\Admin\PresentAbsensi;

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
            'presentAbsensi' => 'required|unique:presentabsensis,presentAbsensi,:id,id,company_id,'.$this->companyId,
            'num_of_leave'=>'required|integer',
            'potongan'=>'required',
            'potongan_shift'=>'required',
            'singkat'=>'required'
        ];
    }

}
