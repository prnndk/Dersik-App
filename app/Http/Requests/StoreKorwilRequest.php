<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKorwilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kota_id' => 'required|exists:regencies,id',
            'PJ' => 'required|unique:korwils,PJ',
            'number' => 'required|numeric|digits_between:10,13|unique:korwils',
            'kontaklain' => 'required|unique:korwils',
            'siswa_id' => 'required|numeric|unique:korwils|exists:users,id',
        ];
    }
}
