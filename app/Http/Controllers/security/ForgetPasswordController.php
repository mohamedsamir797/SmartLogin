<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use http\Exception\BadConversionException;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function forgetpass(){
          return view('security.forgetPassword');
    }
    public function password(Request $request){
        $user = User::whereEmail($request->email)->first();

        if (count((array($user))) == 0){
            return redirect()->back()->with(['error'=>'email is not exist']);
        }
        if (isset($user->id)){
            $user = Sentinel::findById($user->id);
        }else{
            return redirect()->back()->with(['error'=>'your email is not exist']);
        }

        $reminder = Reminder::exists($user) ? : Reminder::create($user);

        $this->sendEmail($user,$reminder->code);

        return redirect()->back()->with(['success'=>'Reset code sent to your email']);
    }

    public function sendEmail($user,$code){
        Mail::send(
            'email.forgot',
            ['user'=>$user,'code'=>$code],
            function ($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->name reset your Password .");
            }
        );
    }

    public function resetpassword($email,$code){
        $user = User::whereEmail($email)->first();

        if (count((array($user))) == 0){
            return redirect()->back()->with(['error'=>'email is not exist']);
        }
        if (isset($user->id)){
            $user = Sentinel::findById($user->id);
        }else{
            return redirect()->back()->with(['error'=>'your email is not exist']);
        }

        $reminder = Reminder::exists($user);

        if ($reminder){

            if ($code){
                return view('security.resetPassword_form')->with(['user'=>$user ,'code'=>$code]);
            }else{
                return redirect('/');
            }
        }else{
            return redirect()->back()->with(['error'=>'Time is expired']);
        }

    }

    public function reset(Request $request,$email,$code){
        request()->validate([
            'password' =>'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12'
        ]);

        $user = User::whereEmail($email)->first();

        if (count((array($user))) == 0){
            return redirect()->back()->with(['error'=>'email is not exist']);
        }
        $user = Sentinel::findById($user->id);


        $reminder = Reminder::exists($user);

        if ($reminder){

            if ($code){
                      Reminder::complete($user,$code,$request->password);
                      return redirect('/login')->with(['success','your password is reset successfully']);
            }else{
                return redirect('/');
            }
        }else{
            return redirect()->back()->with(['error'=>'Time is expired']);
        }
    }

}
