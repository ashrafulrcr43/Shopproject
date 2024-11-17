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
    //Font End Development
    public function loginPage(){
        return view('pages.auth.login');
    }
    public function registration(){
        return view('pages.auth.registration');
    }
    public function sendotp(){
        return view('pages.auth.sendotp');
    }

    public function varifyOtp(){
        return view('pages.auth.varifyotp');
    }
    public function passwordReset(){
        return view('pages.auth.passwordReset');
    }
    public function uerProfilePage(){
        return view('pages.dashboard.profile-form');
    }

   //Back End Developemnt  
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
            ],200);
        }
        catch (Exception $e){
            return response()->json([
            'status' => 'failed', 
            'message'=>'User Registration Failed'
            ]);
        }
       
    }
    public function userLogin(Request $request){
        $count = User::where('email',$request->input('email'))
        ->where('password',$request->input('password'))
        ->select('id')->first();

        if($count !==null){
            //user-login-jwt-token-issue
            $token =JWTToken::createToken($request->input('email'),$count->id);
            return response()->json([
                'status'=>'success',
                'message'=>'user login successful',
                // 'token'=>$token
            ])->cookie('token',$token,60*24*30);

        }else{
            return response()->json([
                'status'=>'Failed',
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
        $count = User::
        where('email','=',$email)
            ->where('otp','=',$otp)
            ->count();
        if($count===1){
            User::where('email','=',$email)->update(['otp'=>'0']);
            // create Token for Rest Password
            $token = JWTToken::createTokenForSetPassword($email);
            return response()->json([
                'status'=>'success',
                'message'=>'Token Create Successfully',
               
            ],200)->cookie('token',$token,60*24*30);

        }else {
            return response()->json([
                'status'=>'Failed',
                'message'=>'unauthorized'
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
                    'message'=>'unauthorized'
                ]);
        }
       
    }
    }
    public function userLogout(){
        return redirect("/userLogin")->cookie('token','',-1);
    }

    // user Detailes
    public function userProfile(Request $request){
        $email =$request->header('email');
        $User= User::where('email','=',$email)->first();
        return response()->json([
            'status'=>'success',
            'message'=>'User Update Successfully',
            'data'=>$User
        ]);
    }

    public function userProfileUpdate(Request $request){
        try{
            $email = $request->header('email');
            $firstName= $request->input('firstName');
            $lastName= $request->input('lastName');
            $phone= $request->input('phone');
            $password= $request->input('password');

            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'phone'=>$phone,
                'password'=>$password
            ]);
            return response()->json([
             'status'=>'success',
             'message'=>'User Profile Update Successfully'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>'Fail',
                'message'=>'somthing wrong'
            ]);
        }
    }
  
}