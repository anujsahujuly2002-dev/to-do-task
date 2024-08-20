<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\FcmToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{
    //

    public function login() {
        return view('admin.auth.login');
    }

    public function doLogin(LoginRequest $request) {
        if(is_null($request->input('fcm_token') )):
            return response()->json([
                "status"=>false,
                "message"=>"Please enable notification popup",
            ],500);
        endif;
        if(!auth()->attempt(['email'=>$request->input('username'),'password'=>$request->input('password')])):
            return response()->json([
                'status'=>false,
                "message"=>"Invalid credentials, Please try again",
            ],401);
        else:
            $userId = auth()->user()->id;
            $checkExistFcmToken = FcmToken::where([ 'user_id'=>$userId,'fcm_tokens'=>$request->input('fcm_token')])->first();
            if(is_null($checkExistFcmToken)):
                FcmToken::create([
                    'user_id'=>$userId,
                    'fcm_tokens'=>$request->input('fcm_token'),
                ]);
            endif;
            return response()->json([
                'status'=>true,
                "message"=>"You're account has been logdin, Please wait redirecting",
                'url'=>route('admin.dashboard'),
            ],200);
        endif;
    }
}
