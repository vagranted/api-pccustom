<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Auth extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }
    public function signup(SignupRequest $request)
    {
        $payload = $request->validated();
        $user = User::create($payload);
        return new JsonResponse([
            'data' => ['token' => $user->createToken('token')->plainTextToken]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $payload = $request->validated();
        $user = User::where('login', $payload['login'])->first();
        if(!Hash::check($payload['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => 'The provided credentials are incorrect'
            ]);
        }

        return new JsonResponse([
            'data' => ['token' => $user->createToken('token')->plainTextToken]
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return new JsonResponse([
            'data' => []
        ], Response::HTTP_NO_CONTENT);
    }
}
