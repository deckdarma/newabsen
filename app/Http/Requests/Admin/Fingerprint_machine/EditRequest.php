<?php

namespace App\Http\Requests\Admin\Fingerprint_machine;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use App\Models\Award;
use App\Models\Fingerprint_machine;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $fingerprint_machine = Fingerprint_machine::find($this->route('fingerprint_machine'));
        return admin() && ($fingerprint_machine);
    }


    public function rules()
    {
        return [
        ];
    }
}
