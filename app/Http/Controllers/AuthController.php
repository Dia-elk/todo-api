<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;


    public function login(LoginUserRequest $request)
    {
        $request->validated();
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('API Token of ' . $user->name)->plainTextToken;

            return $this->success([
                'user' => $user,
                'token' => $token,
            ], 'You Are logged in');
        }
        return $this->error('', 'Credentials does not match', 401);
    }



    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }


    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'you have successfully log out'
        ]);
    }
}
