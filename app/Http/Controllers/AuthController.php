<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
   /* public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }*/

    
      public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;

            return response()->json([
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'error' => 'Email and password doesn\'t exist',
            ], 401);
        }}


        /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /*protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }*/


    
   /* public function signup(Request $request){
        
        User::create($request->all());
        return $this->login($request);
    }*/

    public function signup(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom'=> 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
            'role'=>'required'
        
            
        ]);

        $user = new User;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message' => 'Utilisateur enregistré avec succès',
            'user' => $user
        ]);
    }
}







        

