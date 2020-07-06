<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', '=', $request->email)->firstOrFail();
        
        // inisialisasi
        $status = "error";
        $message = "";
        $data = null;
        $token = null;
        $code = 401;

        if(!$user || !Hash::check($request->password, $user->password)){
            // return response([
            //     'message' => ['These credentials dont match our records.']
            // ], 404);
            $message = "Incorrect username or password.";
            $code = 404;
        }else{
            $status = "Success";
            $message = "Login successfully.";
            $data = $user->toArray();
            $token = $user->createToken('my-app-token')->plainTextToken;
            $code = 200;
        }

        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];
        // return response($response, 201); 
        
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            // 'data' => [
            //     'user' => $data,
            //     'token' => $token
            // ],
            'token' => $token
        ], $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;

        if($validator->fails()){
            // $errors = $validator->errors();
            // return response()->json([
            //     'data' => [
            //         'message' => $errors
            //     ]
            // ],400);
            $errors = $validator->errors();
            $message = $errors;
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => json_encode(['customer'])
            ]);

            if($user){
                $status = 'success';
                $message = 'register succesfully';
                $data = $user->toArray();
                $code = 200;
            }else{
                $message = 'register failed, something went wrong.';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function logout(Request $request)
    {
        $user = \Auth::user();
        if($user){
            // Revoke all tokens...
            $user->tokens()->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'logout successfully',
            'data' => null,
        ], 200);
    }
}
