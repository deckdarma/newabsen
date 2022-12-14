<?php

namespace App\Http\Requests\Admin\LeaveType;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Leavetype;

class EditRequest extends AdminCoreRequest
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
		  'num_of_leave'=>'required|integer',
            'potongan'=>'required',
            'waktumundur'=>'required',
            'potongan_shift'=>'required',
            'singkat'=>'required'
        ];
    }
}
