<?php

namespace App\Http\Requests\Admin\Liburshift;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use App\Models\Award;
use App\Models\Liburshift;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $liburshift = Liburshift::find($this->route('liburshift'));
        return admin() && $liburshift;
    }


    public function rules()
    {
        return [
        ];
    }
}
