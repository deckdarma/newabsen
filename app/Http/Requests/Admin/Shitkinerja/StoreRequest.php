<?php

namespace App\Http\Requests\Admin\Shitkinerja;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends AdminCoreRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'total_allowance'=>'required',
            'total_deduction'=>'required',
            'jumlah_prestasi_kehadiran'=>'required',
            'jumlah_prestasi_kinerja'=>'required',
            'total_prestasi_kinerja'=>'required',
            'pemotongan_cuti_kinerja'=>'required',
            'pemotongan_hukuman_kinerja'=>'required',
            'total_pemotongan_kinerja'=>'required',
            'total_bobot_kinerja'=>'required',
            'nilai_tpp_kinerja'=>'required',
            'jumlah_kotor_kinerja'=>'required',
            'nilai_pajak_kinerja'=>'required',
            'jumlah_iwp'=>'required',
            'jumlah_bersih_keseluruhan'=>'required'
        ];
    }

}
