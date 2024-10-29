<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function userRegistration(Request $request){
        try {
            User::create([
                'firstName'=> $request->input('firstName'),
                'lastName'=> $request->input('lastName'),
                'email'=> $request->input('email'),
                'phone'=> $request->input('phone'),
                'password'=> $request->input('password'),
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'User Registration Successfully'
            ]);
        }
        catch (Exception $e){
            return response()->json([
                'status'=>'Faild',
                'message'=>'User Registration Failed'
            ]);
        }
       
    }
    public function userLogin(Request $request){
        $count = User::where('email',$request->email)
        ->where('password',$request->password)
        ->count();

        if($count==1){
            //user-login-jwt-token-issue
            $token =JWTToken::createToken($request->email);
            return response()->json([
                'status'=>'success',
                'message'=>'user login successful',
                'token'=>$token
            ]);

        }else{
            return response()->json([
                'status'=>'faild',
                'message'=>'unauthorized'
            ]);
        }
    }
    public function sendOtpCode(Request $request){
        $email = $request->input('email');
        $otp = rand(1000,9999);
        $count = User::Where('email','=',$email)->count();

        if($count == 1){
            //otp user email send 
            Mail::to($email)->send(new OTPMail($otp));
            //otp Database store korta hoba
            User::where('email','=',$email)->update(['otp' => $otp]);
            return response()->json([
                 'status'=>'success',
                'Message'=>'4 Digit Otp Send Successfully'
            ]);
        }else {
            return response()->json([
                'status'=>'Failed',
                'Message'=>'unauthorized'
            ]);
        }
    }

    public function verifyOtp(Request $request){
        $email = $request->input('email');
        $otp = $request ->input('otp');
        $count = User::where('email','=',$email)
            ->where('otp','=',$otp)->count();
        if($count){
            
            // create Token for Rest Password
            $token = JWTToken::createTokenForSetPassword($request->email);
            return response()->json([
                'status'=>'success',
                'message'=>'Token Create Successfully',
                'token'=>$token
            ]);

        }else {
            return response()->json([
                'status'=>'Failed',
                'Message'=>'unauthorized'
            ]);
        }

    }
    public function restPasword(Request $request){
        try{
        $email =$request->header('email');
          $password = $request->input('password');
        User::where('email','=',$email)->update(['password'=> $password]);
        return response()->json([
            'status'=>'success',
            'message'=>'Password Rest Successfully',
           
        ]);
        } catch(Exception $e){
             {
                return response()->json([
                    'status'=>'Failed',
                    'Message'=>'unauthorized'
                ]);
        }
       
    }
    }
}
