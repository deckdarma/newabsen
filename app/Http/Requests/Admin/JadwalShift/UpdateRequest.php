<?php

namespace App\Http\Requests\Admin\JadwalShift;

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
   	
'jam_masuk'=>'required',
'jam_akhir_masuk'=>'required',
'jam_pulang'=>'required',
'jam_akhir_pulang'=>'required',


'id_ONTIME'=>'required',
'ONTIME_masuk'=>'required',
'ONTIME_pulang'=>'required',



'id_SKOR1'=>'required',
'SKOR1_masuk'=>'required',
'SKOR1_pulang'=>'required',


'id_SKOR2'=>'required',
'SKOR2_masuk'=>'required',
'SKOR2_pulang'=>'required',


'id_SKOR3'=>'required',
'SKOR3_masuk'=>'required',
'SKOR3_pulang'=>'required',


'id_SKOR4'=>'required',
'SKOR4_masuk'=>'required',
'SKOR4_pulang'=>'required',


'jam_masuk_jumat'=>'required',
'jam_akhir_masuk_jumat'=>'required',
'jam_pulang_jumat'=>'required',
'jam_akhir_pulang_jumat'=>'required',


'id_jumat_ONTIME'=>'required',
'ONTIME_masuk_jumat'=>'required',
'ONTIME_pulang_jumat'=>'required',



'id_jumat_SKOR1'=>'required',
'SKOR1_masuk_jumat'=>'required',
'SKOR1_pulang_jumat'=>'required',


'id_jumat_SKOR2'=>'required',
'SKOR2_masuk_jumat'=>'required',
'SKOR2_pulang_jumat'=>'required',


'id_jumat_SKOR3'=>'required',
'SKOR3_masuk_jumat'=>'required',
'SKOR3_pulang_jumat'=>'required',


'id_jumat_SKOR4'=>'required',
'SKOR4_masuk_jumat'=>'required',
'SKOR4_pulang_jumat'=>'required'
     
     
        ];
    }
}
