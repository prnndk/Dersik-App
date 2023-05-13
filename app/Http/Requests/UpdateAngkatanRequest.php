<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAngkatanRequest extends FormRequest
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
            // 'nama' => 'required|min:3|unique:angkatans,nama',
            // 'email' => 'required|email:dns|unique:angkatans',
            // 'tahun' => 'required|digits:4|unique:angkatans',
            // 'ig' => 'required|unique:angkatans',
            // 'ketua' => 'nullable|unique:angkatans|min:5',
            // 'logo' => 'nullable|file|mimes:png,jpg,svg',
            // 'filosofi' => 'nullable|min:10',
        ];
    }
}
