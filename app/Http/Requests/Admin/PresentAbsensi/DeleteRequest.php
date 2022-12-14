<?php

namespace App\Http\Requests\Admin\PresentAbsensi;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Presentabsensi;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $presentAbsensi = Presentabsensi::find($this->route('presentabsensi'));
        return admin() && $presentAbsensi;
    }


    public function rules()
    {
        return [
        ];
    }
}
