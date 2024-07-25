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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users', 'required_without:phone'],
            'phone' => ['nullable', 'string', 'max:15', 'required_without:email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $userData =
            [
                'name' => $input['name'],
                'password' => Hash::make($input['password']),
                'image' => 'userpf.png',
                'gender' => 'male',
            ];
        if($input['email'] != null){
            $userData['email'] = $input['email'];
        };
        if($input['phone'] != null){
            $userData['phone'] = $input['phone'];
        };
        return User::create($userData);
    }
}
