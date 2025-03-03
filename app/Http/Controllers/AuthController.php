<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Traits\HttpResponses;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResponse;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyEmailRequest;
use Illuminate\Auth\Notifications\VerifyEmail;

class AuthController extends Controller
{
    use HttpResponses;
    
    public $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        return $this->authService->register($validated);
      
    }

    public function verifyEmail(VerifyEmailRequest $request) {
        $validated = $request->validated();
        return $this->authService->verifyEmail($validated);
    }

    public function login(LoginRequest $request){
        $validated = $request->validated();
        return $this->authService->login($validated);

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return $this->success('Logged out successfully');
    }
}
