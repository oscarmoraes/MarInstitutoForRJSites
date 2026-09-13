<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas. Verifique seu e-mail e senha.',
            ], 401);
        }

        $token = $user->createToken('mobile_app_token')->plainTextToken;
        $member = Member::where('email', $user->email)->first() ?? Member::first();

        return response()->json([
            'success' => true,
            'message' => 'Autenticado com sucesso!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'member' => $member,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sessão encerrada com sucesso.',
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        $member = Member::where('email', $user->email)->first() ?? Member::first();

        return response()->json([
            'success' => true,
            'user' => $user,
            'member' => $member,
        ]);
    }
}
