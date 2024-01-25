<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\Validator;
class AuthController extends Controller
{
   // login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password'=>'required'
        ]);

        if(!auth('api_user')->attempt($loginData)){
            return response(['message'=>'Invalid Credentials']);
        }

        $accessToken = auth('api_user')->user()->createToken('authToken')->accessToken;

        return response(['user'=>auth('api_user')->user(),'access_token'=>$accessToken]);
    }



    public function register(Request $request)
{
    $userData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = Customer::insert([
        $psw=Hash::make($userData['password']),
        'name' => $userData['name'],
        'email' => $userData['email'],
        'password' =>$psw,
    ]);

    $accessToken = auth('api_user')->user()->createToken('authToken')->accessToken;

    return response(['user' => $user, 'access_token' => $accessToken]);
}




    public function logout(Request $request)
    {
        Auth::guard('api')->user()->token()->revoke();
        return response(['message'=>'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response(['user'=>Auth::guard('api')->user()]);
    }

}
