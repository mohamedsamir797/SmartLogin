<?php

namespace App\Http\Controllers\security;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class loginController extends Controller
{
    public function login(){
        if (Sentinel::check()){
            return redirect('/');
        }
        return view('security.login');
    }
    public function postlogin(Request $request){

        Sentinel::disableCheckpoints();

         request()->validate([
             'email'=> 'required',
             'password'=> 'required',

         ]);

        if ($request->remember == 'on'){
            try{
             $user = Sentinel::authenticateAndRemember($request->all());
            }catch (ThrottlingException $e){
              $delay = $e->getDelay();
                request()->validate([
                    'email'=> 'required',
                    'password'=> 'required',

                ]);

                return redirect()->back()->with(['msg'=>" you are banned for $delay secondes."]);

            }catch (NotActivatedException $e){
                request()->validate([
                    'email'=> 'required',
                    'password'=> 'required',

                ]);
                return redirect()->back();

            }
        }else{
            try{
                $user = Sentinel::authenticate($request->all());
            }catch (ThrottlingException $e){
                request()->validate([
                    'email'=> 'required',
                    'password'=> 'required',

                ]);
                return redirect()->back();

            }catch (NotActivatedException $e){
                request()->validate([
                    'email'=> 'required',
                    'password'=> 'required',

                ]);

            }
        }

        if (Sentinel::check()){
            return redirect('/');
        }else{
            request()->validate([
                'email'=> 'required',
                'password'=> 'required',

            ]);
            return redirect()->back()->with(['msg'=>" your email or password mismatched "]);
        }

    }
    public function logout(){
        Sentinel::logout();
        return redirect('/login');
    }
}
