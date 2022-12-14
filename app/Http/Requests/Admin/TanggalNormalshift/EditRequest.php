<?php

namespace App\Http\Requests\Admin\TanggalNormalshift;

use App\Http\Requests\AdminCoreRequest;
use App\Models\TanggalNormalshift;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $leaveType = TanggalNormalshift::find($this->route('tanggal_normalshift'));
        return admin() && $leaveType;
    }


    public function rules()
    {
        return [
        ];
    }
}
