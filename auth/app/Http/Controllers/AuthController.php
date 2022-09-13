<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     return User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password')),
    //     ]);
    // }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string',
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
        return $this->successAuthResponse($user);
    }

    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(['message' => 'Invalid credentials!'], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        //Session::put('token', $token);
        $cookie = cookie('jwt', $token, 60 * 24);
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }


    public function user()
    {
        $user = Auth::user();
        return $this->successAuthResponse($user);
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        //Session::flush();
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
