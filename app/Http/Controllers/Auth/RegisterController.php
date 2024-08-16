<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ViaCepService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            User::create($input);
            return response()->json([
                'message' => 'Conta criada com sucesso! Redirecionando para a página de login...',
                'redirect' => route('login')
            ], 200);
        } catch (Exception $exception) {
            Log::error($exception, $request->all());
            return response()->json(['error' => 'Não foi possível realizar o cadastro!'], 500);
        }
    }

    public function getViaCep(Request $request, ViaCepService $viaCepService)
    {
        try {
            $addressData = $viaCepService->getAddressFromCep($request->zip_code);
            return response()->json($addressData, 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }


}
