<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Authcontroller extends Controller
{
    public function login(Request $request){
     $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:8',
     ]);
     $user=User::where('email',$request->email)->first();
     if(!$user ||!Hash::check($request->password,$user->password)){
        return response()->json(['message'=>'failed']);
     }
     $token=$user->createToken($request->email)->plainTextToken;
     $response=['message'=>'user is logged in successfuly','user'=>$user,'Token'=>$token];
     return response()->json($response,200);
    }
    public function logout(){
        auth()->user()->Tokens()->delete();
        return response()->json(['message'=>'successful']);
    }
}
