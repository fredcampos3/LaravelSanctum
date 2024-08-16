<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function listUsers()
    {
        try {
            $users = User::query()->get()->map(function ($user){
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'created' => $user->created_at->format('d/m/Y H:i'),
                    'city' => $user->city,
                    'state' => $user->state,
                ];
            })->values();
            return response()->json(['users' => $users], 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }
}
