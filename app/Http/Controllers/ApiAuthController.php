<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApiAuthController extends Controller
{
    public function login(Request $request){


         $data = Validator::make($request->all(), [
             'email' => 'required|email',
             'password' => 'required|string|min:6',
         ]);

         if ($data->fails()) {
             return response()->json(
                 [
                     'errors' => $data->errors(),
                 ], 422);
         }


         $user = User::where('email', $request->email)->first();

         if (!$user || !Hash::check($request->password, $user->password)) {
             return response([

                 'message' => 'These credentials do not match our records.',
                 'errors'   => 'Invalid Credentials'
             ],401);
         }

         $token = $user->createToken('kanox_auth')->plainTextToken;

         $response = [
             'user' => $user,
             'errors' => 0,
             'token' => $token,
             'message' => 'success'
         ];

         return response($response, 201);
     }

    public function register(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user = new User;
        $user->name         = $request->full_name;
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        $user->save();

        $token = $user->createToken('kanox_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'errors' => 0,
            'token' => $token,
        ],200);

    }

    public function authUser(Request $request){

        if (auth()->check()) {
            $user = $request->user();
            return  $user ;
        } else {

            return [
                'message' => 'unauthorised'
            ];
        }
    }
}
