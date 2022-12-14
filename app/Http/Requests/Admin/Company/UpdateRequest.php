<?php

namespace App\Http\Requests\Admin\Company;

use App\Http\Requests\AdminCoreRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'sub_domain' => module_enabled('Subdomain') && admin()->type == 'superadmin'?'required|min:4|max:50|sub_domain|unique:companies,sub_domain,'.$this->route('company'):'',
            'email' => 'required|email',
            'name' => 'required',
            'waktumundur' => 'required',
            'datashift' => 'required',
            'logo' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:1000'
        ];
    }
	
			    public function messages()
    {
        return [
                   'company_name.required' => 'Nama OPD Harus di isi',
            'password.required' => 'Kata Sandi Harus di isi',
            'email.required' => 'Email Harus di isi',
            'name.required' => 'Singkatan OPD Wajib di isi',
            'datashift.required' => 'Silahkan Pilih Shift',
            'waktumundur.required' => 'Waktu Mundur Harus di isi',
     
            'email.email' => 'Email Sudah Ada',
        ];
    }

	

    public function prepareForValidation()
    {
        if (empty($this->sub_domain)) {
            return;
        }

        // Add servername domain suffix at the end
        $subdomain = trim($this->sub_domain, '.') . '.' . get_domain();
        $this->merge(['sub_domain' => $subdomain]);
        request()->merge(['sub_domain' => $subdomain]);
    }
}
