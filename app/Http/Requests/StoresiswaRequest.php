<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoresiswaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama'=>'required|unique:siswas',
            'email'=>'required|unique:siswas|email:dns',
            'kelas'=>'required|numeric',
            'status'=>'required|numeric',
            'instansi'=>'required_if:status,=,[1,2,4]|required_if:tidak_ada,off',
            'instansi_manual'=>'required_if:tidak_ada,on',
            'detail_status'=>'required|string',
            'domisili'=>'required|numeric',
            'teman_smasa'=>'required',
            'angkatan_id'=>'required|numeric',
            'nomor'=>'required|digits_between:10,13|unique:siswas'
        ];
    }
}
