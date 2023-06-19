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
        $validatedData = $request->validate([
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|confirmed|min:6',
            //'password_confirm'=> 'required|same:password',

        ]);

        $user = User::create([
            'nom'=> $validatedData['nom'],
            'nom'=> $validatedData['prenom'],
            'nom'=> $validatedData['email'],
            'nom'=> bcrypt($validatedData['password']),
        ]);
        // $user->nom = $request->input('nom');
        // $user->prenom = $request->input('prenom');
        // $user->email = $request->input('email');
        // $user->password = Hash::make($request->input('password'));
        // $user->save();

        return response()->json(
            $user,
            201
        );
    }


    public function blockUser($id){
        $user = User::findOrFail($id);
        $user->blocked_at = now();
        $user->save();

        return response()->json(['message'=>'Utilisateur bloqué avec succès']);
    }


    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message'=>'Utilisateur supprimé avec succès']);
    }



    public function logout()
    {
        $user = request()->user();

        if($user){
            $user->tokens->each(function (Token $token){
                $token->delete();
            });
        }

        return response()->json(['message' => 'Successfully logged out']);
    }


}







        

