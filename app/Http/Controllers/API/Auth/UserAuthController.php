<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\UserProfileRequest;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'user' => $user->only(['id', 'name', 'email', 'phone',]),
            'token' => $user->createToken('user-application')->plainTextToken
        ], 201);

        // return new CustomerResource($customer);
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        auth()->user()->update($data);

        return response()->json(auth()->user()->only(['id', 'name', 'email', 'phone',]), 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where("{$field}", $request->identity)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'identity' => ['بيانات الاعتماد المقدمة غير صحيحة.'],
            ]);
        }

        return response()->json([
            'user' => $user->only(['id', 'name', 'email', 'phone', 'address']),
            'token' => $user->createToken('user-application')->plainTextToken
        ], 200);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json('User Logged out');
    }

}






