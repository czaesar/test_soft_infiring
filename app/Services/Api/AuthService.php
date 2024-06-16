<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function register($data)
    {

        DB::beginTransaction();

        try {
            $data['role_id'] = 2;
            $user = User::create($data);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;

            DB::commit();

            return $token;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Registration failed: '.$e->getMessage());

            return response()->json(['error' => 'Registration failed', 'message' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];

                return $response;
            } else {
                $response = ['message' => 'Password mismatch'];

                return response($response, 422);
            }
        } else {
            $response = ['message' => 'User does not exist'];

            return response($response, 422);
        }
    }
}
