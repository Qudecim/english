<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginError;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Register new user
     *
     * @param Request $request
     * @return array
     */
    public function register(Request $request): array
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return [
            'token' => $user->createToken('MyApp')->plainTextToken
        ];
    }

    /**
     * Login
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request): array
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return [
                'success' => true,
                'token' => $user->createToken('MyApp')->plainTextToken
            ];
        }

        return [
            'success' => false
        ];
    }
}
