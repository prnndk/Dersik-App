<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'min:5','max:255'],
            'username' => ['required', 'string', 'min:4','max:255', 'unique:users'],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users',],
            'kelas_id'=>'required',
            'tempatlahir'=>'required',
            'dob'=>'required',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'username'=>$input['username'],
            'dob'=>$input['dob'],
            'tempatlahir'=>$input['tempatlahir'],
            'kelas_id'=>$input['kelas_id']
        ]);
    }
}
