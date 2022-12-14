<?php

namespace App\Http\Requests\Admin\NormalAbsensi;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Normalabsensi;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $Normalabsensi = Normalabsensi::find($this->route('normalabsensi'));
        return admin() && $Normalabsensi;
    }


    public function rules()
    {
        return [
        ];
    }
}
