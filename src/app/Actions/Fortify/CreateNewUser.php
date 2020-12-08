<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $imageName = time() . uniqid() . '.webp';
        $thumb = Image::make($input['image']);
        $thumb_large = $thumb->widen(500)->encode('webp');
        Storage::disk('local')->put('public/images/users/' . $imageName, $thumb_large);

        return User::create([
            'name' => $input['name'],
            'image' =>$imageName,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
