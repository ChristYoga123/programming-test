<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Formatter\ResponseFormatterController as ResponseFormatter;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:255",
            "email" => "required|email|email:dns",
            "password" => "required|min:8"    
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
        $user->assignRole("User");
        $token = $user->createToken("MyAppToken")->plainTextToken;

        $new_user = [
            "user" => $user,
            "token" => $token
        ];

        return ResponseFormatter::success($new_user, "User berhasil registrasi", Response::HTTP_ACCEPTED);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($request->only("email", "password")))
        {
            $user = auth()->user();
            $token = $user->createToken('MyAppToken')->plainTextToken;
            $logged_user = [
                'user' => $user,
                'token' => $token
            ];

            return ResponseFormatter::success($logged_user, "User berhasil login", 200);
        }
        return ResponseFormatter::error("User gagal login", 401);
    }
    
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
