<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\RegisterMail;
use App\Traits\HttpResponses;
use App\Http\Resources\UserResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthService
{
    use HttpResponses;
    public function register($validated){
        $validated['password'] = Hash::make($validated['password']);
        $otp = rand(100000, 999999);
        $validated['otp'] = $otp;
        $validated['otp_expired_at'] = Carbon::now()->addMinutes(10);
        $user = User::create($validated);
        Mail::to($user->email)->send(new RegisterMail($user['first_name'], $otp));
        // return $user;

        return $this->success(
            'Registration successful. Check your email for the OTP',
            new UserResponse($user)
        );
    }


    public function verifyEmail($validated) {
        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            return $this->error(null, 'User not found.', 404);
        }
        if ($user->otp !== $validated['otp']) {
            return $this->error(null, 'Invalid OTP.', 400);
        }

        if (Carbon::parse($user->otp_expired_at)->isBefore(Carbon::now())) {
            return $this->error(null, 'OTP has expired.', 400);
        }
        $user->email_verified_at = Carbon::now();
        $user->otp = null; // Clear OTP after successful verification
        $user->otp_expired_at = null; // Clear OTP expiration time
        $user->save();

        $data = $this->generateUserAndToken($user);

        return $this->success('Email verified successfully', $data);
    }

    public function login($validated) {
        $user = User::where('email', $validated['email'])->first();
        
        if(!$user) {
            return $this->error(null, 'User not found.', 404);
        }

        if(!Hash::check($validated['password'], $user->password)){
            return $this->error(null, 'Invalid credentials.', 401);
        }
        $data = $this->generateUserAndToken($user);

        return $this->success('Login successfully', $data);

    }


    public function logout($request) {
      
        $request->$user()->tokens()->delete();
        return $this->success('Logged out successfully');
    }
    private function generateUserAndToken($user)
    {

        $token = $user->createToken('YourAppName')->plainTextToken;
        $userResource = new UserResponse($user);
        return $data = [
            'user' => $userResource,
            'token' => $token
        ];
    }
}
  