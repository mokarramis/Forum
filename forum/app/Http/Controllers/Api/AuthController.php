<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(registerRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_confirmation' => $request->password_confirmation
        ]);

        $token = $user->createToken('API Token')->accessToken;

        return response([
            'status' => 'success',
            'token' => $token,
            'message' => trans('api.user.register')
        ]);
    }

    public function login(loginRequest $request) {
        $cred = $request->only ('email', 'password');

        if(Auth::attempt($cred)) {
            
            $user = auth()->user();
            return response([
                'status' => 'true',
                'token' => $user->createToken('API Token')->accessToken,
                'message' => trans('api.user.login.success')
            ]);

        }
        return response([
            'status' => 'false',
            'message' => trans('api.user.login.failed')
        ]);

    }
}
