<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                "success" => false,
                "message" => 'Invalid email or password'
            ], 401);
        }
        // get the user
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => $user
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the authenticated User.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function meUpdate(Request $request)
    {
        if (auth()->user() != null) {
            $user = User::findOrFail(auth()->user()->id);
            $imageName = $user->image_file;

            if ($request->image != null) {
                $imageName = time() . uniqid() . '.webp';
                $thumb = Image::make($request->file('image'));
                $thumb_large = $thumb->widen(500)->encode('webp');
                Storage::disk('local')->put('public/images/users/' . $imageName, $thumb_large);
            }

            $user->update([
                'name' => $request->name ?? $user->name,
                'image' => $imageName,
                'phone' => $request->phone ?? $user->phone,
                'email' => $request->email ?? $user->email,
//                'image' => $request->image
            ]);

            $user->save();
        }
        return response()->json(auth()->user());
    }


    public function refresh(Request $request)
    {
        if (!JWTAuth::getToken()) {
            return response()->json([
                "success" => false,
                "message" => 'Token is required'
            ], 422);
        }
        try {
            $refreshed = JWTAuth::refresh(JWTAuth::getToken());
            $user = JWTAuth::setToken($refreshed)->toUser();
            return response()->json([
                "success" => true,
                "message" => $refreshed
            ], 200);
        } catch (JWTException $exception) {
            return response()->json([
                "success" => false,
                "message" => 'Sorry, the token cannot be refreshed'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        if (!User::checkToken($request)) {
            return response()->json([
                "success" => false,
                "message" => 'Token is required'
            ], 422);
        }
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                "success" => true,
                "message" => 'User logged out successfully'
            ], 200);
        } catch (JWTException $exception) {
            return response()->json([
                "success" => false,
                "message" => 'Sorry, the user cannot be logged out: ' . $exception->getMessage()
            ], 500);
        }
    }
}
