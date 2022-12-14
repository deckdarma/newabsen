<?php

namespace App\Http\Requests\Admin\NormalshiftAbsensi;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Normalshiftabsensi;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $Normalshiftabsensi = Normalshiftabsensi::find($this->route('normalshiftabsensi'));
        return admin() && $Normalshiftabsensi;
    }


    public function rules()
    {
        return [
        ];
    }
}
