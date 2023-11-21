<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ResponseHeader;

class UserController extends Controller
{
    public function UserLogin(Request $request){ 
        try {
            $UserEmail = $request->UserEmail;
            $OTP = rand(100000, 999999);
            $details = ['code'=> $OTP];
            Mail::to($UserEmail)->send(new OTPMail($details));
            User::updateOrCreate(['email'=>$UserEmail], ['email'=>$UserEmail , 'OTP'=>$OTP]);
            return ResponseHelper::Out('Success', 'A 6 disit OTP sent to your email!', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('fail',$e,200);
        }
    }

    public function VarifyLogin(Request $request){
        $UserEmail = $request->UserEmail;
        $OTP = $request->OTP;
        $varification = User::where('email', $UserEmail)->where('otp', $OTP)->first();
        if($varification){
            User::where('email',$UserEmail)->where('otp', $OTP)->first();
        }
    }
}
