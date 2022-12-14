<?php

namespace App\Http\Requests\Admin\DataPemimpin;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Datapemimpin;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $dataPemimpin = Datapemimpin::find($this->route('datapemimpin'));
        return admin() && $dataPemimpin;
    }


    public function rules()
    {
        return [
        ];
    }
}
