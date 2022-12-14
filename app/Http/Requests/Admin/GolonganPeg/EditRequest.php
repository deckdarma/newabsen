<?php

namespace App\Http\Requests\Admin\GolonganPeg;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Golonganpeg;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $golonganPeg = Golonganpeg::find($this->route('golonganpeg'));
        return admin() && $golonganPeg;
    }


    public function rules()
    {
        return [
        ];
    }
}
