<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRegisPromRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|unique:regis_proms',
            'email' => 'required|unique:regis_proms|email:dns',
            'kelas_id' => 'required',
            'kesediaan' => 'required',
            'kedinasan' => 'required',
            'tanggal' => 'date|nullable|required_if:kedinasan,==,Ikut',
            'no_hp' => 'required|digits_between:10,13|unique:regis_proms',
        ];
    }
}
