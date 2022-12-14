<?php

namespace App\Http\Requests\Admin\Shitkinerja;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Leavetype;
use App\Models\Shitkinerja;

class ShowRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $shitkinerja = Shitkinerja::find($this->route('shitkinerja'));
        return admin() && $shitkinerja;
    }


    public function rules()
    {
        return [

        ];
    }
}
