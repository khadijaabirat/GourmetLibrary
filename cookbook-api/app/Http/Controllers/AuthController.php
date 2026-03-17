<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $user  = User::where('email', $request->email)->firstOrFail();
          if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Les identifiants sont incorrects.'
        ], 401);
    }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Connexion réussie',
            'user'         => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Erreur serveur',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
