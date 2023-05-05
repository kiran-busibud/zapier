<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): JsonResponse
    {
        Log::info('request',[$request]);
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',   
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // return response()->json(['error' => 'Unauthorized'], 401);

    }
}
