<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
    
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:2|max:50'
        ]);
        $messages = $validator->errors()->all();
        if ($validator->fails()) {
            return response()->json(['error' =>$messages], 200);
        }

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                 'success' => false,
                 'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                 'success' => false,
                 'message' => 'Could not create token.',
                ], 500);
        }
  
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
    public function get_user()
    {
        return response()->json(auth('api')->user());
    }


}
