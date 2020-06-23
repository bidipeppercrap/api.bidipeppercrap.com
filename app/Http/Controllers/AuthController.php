<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\RegisterRoot;
use App\Http\Requests\LoginUser;

class AuthController extends Controller
{
    public function register(RegisterUser $request)
    {
        $validated = $request->validated();
        $validated['key'] = Hash::make($validated['key']);
        $user = new User($validated);

        $user->save();

        $token = $user->createToken(env('APP_NAME'))->accessToken;

        return $token;
    }

    public function registerRoot(RegisterRoot $request)
    {
        $validated = $request->validated();
        $validated['key'] = Hash::make($validated['key']);
        $validated['role'] = 'root';
        $root = new User($validated);

        $root->save();

        $token = $root->createToken(env('APP_NAME'))->accessToken;

        return $token;
    }
}
