<?php

namespace App\Http\Requests\Admin\LeaveType;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = Reply::failedToastr($validator);
        throw new HttpResponseException(response()->json($response, 200));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'leaveType' => 'required|unique:leavetypes,leaveType,'.$this->leavetype.',id,company_id,'.$this->companyId,
            'num_of_leave'=>'required',
            'potongan'=>'required',
               'waktumundur'=>'required',
			   'singkat'=>'required'
        ];
    }
}
