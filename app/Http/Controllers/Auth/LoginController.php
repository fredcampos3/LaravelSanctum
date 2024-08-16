<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'E-mail e/ou Senha invalidos!'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'access_token' => $token,
            'user_name' => $user->name,
            'token_type' => 'Bearer',
            'redirect' => route('home')
        ], 200);
    }

    public function logout(Request $request)
    {
        try {

            if ($request->user()->currentAccessToken()) {
                $request->user()->currentAccessToken()->delete();
            }

            return response()->json([
                'message' => 'Logout realizado com sucesso!',
                'redirect' => route('login')
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
