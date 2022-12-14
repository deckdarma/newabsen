<?php

namespace App\Http\Requests\Admin\TanggalAbsensi;

use App\Http\Requests\AdminCoreRequest;
use App\Models\TanggalAbsensi;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $leaveType = Leavetype::find($this->route('leavetype'));
        return admin() && $leaveType;
    }


    public function rules()
    {
        return [
        ];
    }
}
