<?php

namespace App\Http\Requests\Admin\TanggalAbsensi;

use App\Http\Requests\AdminCoreRequest;
use App\Models\TanggalAbsensi;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $leaveType = TanggalAbsensi::find($this->route('tanggal_absensi'));
        return admin() && $leaveType;
    }


    public function rules()
    {
        return [
        ];
    }
}
