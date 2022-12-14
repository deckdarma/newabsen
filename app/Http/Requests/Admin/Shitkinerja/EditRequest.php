<?php

namespace App\Http\Requests\Admin\Shitkinerja;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Leavetype;
use App\Models\Payroll;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $shitkinerja = Payroll::find($this->route('shitkinerja'));
        return admin() && $shitkinerja;
    }


    public function rules()
    {
        return [

        ];
    }
}
