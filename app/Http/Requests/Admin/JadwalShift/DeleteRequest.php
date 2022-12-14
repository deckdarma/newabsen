<?php

namespace App\Http\Requests\Admin\JadwalShift;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Jadwalshift;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $Jadwalshift = Jadwalshift::find($this->route('jadwalshift'));
        return admin() && $Jadwalshift;
    }


    public function rules()
    {
        return [
        ];
    }
}
