<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Notifications\NotifyBot;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users'],
            'kelas_id' => 'required|exists:kelas,id',
            'angkatan_id' => 'required|exists:angkatans,id',
            'tempatlahir' => 'required',
            'dob' => 'required|date',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        Notification::send(User::first(), new NotifyBot('Registrasi User Baru dengan nama '.$input['name']));

        return User::create([
            'name' => $input['name'],
            'uuid' => Str::uuid(),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'username' => $input['username'],
            'dob' => $input['dob'],
            'role' => 'User',
            'tempatlahir' => $input['tempatlahir'],
            'kelas_id' => $input['kelas_id'],
            'angkatan_id' => $input['angkatan_id'],
        ]);
    }
}
