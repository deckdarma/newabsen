<?php

namespace App\Http\Requests\Admin\DataSkor;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Dataskor;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $dataSkor = Dataskor::find($this->route('dataskor'));
        return admin() && $dataSkor;
    }


    public function rules()
    {
        return [
        ];
    }
}
