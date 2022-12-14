<?php

namespace App\Http\Requests\Admin\LeaveApplication;

use App\Http\Requests\AdminCoreRequest;
use App\Models\LeaveApplication;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $leaveType = LeaveApplication::find($this->route('leave_application'));
        return admin() && $leaveType;
    }


    public function rules()
    {
        return [
        ];
    }
}
