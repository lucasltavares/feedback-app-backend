<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('main')->plainTextToken,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('main');
            $token->accessToken->expires_at = now()->addDays(1);
            $token->accessToken->save();
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete(); // Or tokens()->delete() for all tokens.
        return response()->json([
            'message' => 'Logged out',
        ], 200);
    }

    public function redirect()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return Response::json(['url' => $url]);
    }

    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::where('email', $user->email)->first();
        // If user already exists return the user.
        if ($finduser) {
            $token = $finduser->createToken('main');
            $token->accessToken->expires_at = now()->addDays(1);
            $token->accessToken->save();
            return response()->json([
                'user' => $finduser,
                'token' => $token->plainTextToken,
            ]);
        // If user does not exist create a new user.
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
            ]);
            $token = $newUser->createToken('main');
            $token->accessToken->expires_at = now()->addDays(1);
            $token->accessToken->save();
            return response()->json([
                'user' => $newUser,
                'token' => $token->plainTextToken,
            ]);
        }
    }
}
