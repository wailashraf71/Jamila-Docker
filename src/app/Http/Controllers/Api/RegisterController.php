<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends LoginController
{
    public function register(Request $request)
    {
        $findEmail = User::where('email', $request->email)->first();
        if ($findEmail !== null) {
            return response()->json([
                "success" => false,
                "message" => 'Record exist'
            ], 401);
        } else {
            $plainPassword = $request->password;
            $password = bcrypt($request->password);
            $request->request->add(['password' => $password]);
            // create the user account
            $created = User::create($request->all());
            $request->request->add(['password' => $plainPassword]);
            // login now..
            return $this->login($request);
        }

    }
}
