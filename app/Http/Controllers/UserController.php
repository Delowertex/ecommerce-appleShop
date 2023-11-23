<?php

namespace App\Http\Controllers;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserLogin(Request $request){ 
        try {
            $UserEmail=$request->UserEmail;
            $OTP=rand (100000,999999);
            $details = ['code' => $OTP];
            Mail::to($UserEmail)->send(new OTPMail($details));
            User::updateOrCreate(['email' => $UserEmail], ['email'=>$UserEmail,'otp'=>$OTP]);
            return ResponseHelper::Out('success',"A 6 Digit OTP has been send to your email address",200);
        } catch (Exception $e) {
            return ResponseHelper::Out('failed!',$e,200);
        }
    }

    public function VarifyLogin(Request $request){
        $UserEmail = $request->UserEmail;
        $OTP = $request->OTP;
        $varification = User::where('email', $UserEmail)->where('otp', $OTP)->first();
        if($varification){
            User::where('email',$UserEmail)->where('otp', $OTP)->update(['otp'=>'0']);
            $token = JWTToken::CreateToken($UserEmail, $varification->id);
            return ResponseHelper::Out('Success',"", 200)->cookie('token', $token, 60*60*30);
        }else{
            return ResponseHelper::Out('Failed!', Null, 401);
        }
    }

    public function UserLogout(){
        return redirect('/')->cookie('token', -1);
    }
}
