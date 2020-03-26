<?php

namespace App\Http\Controllers\security;
use App\Models\roles\RoleModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Activation;
use Illuminate\Support\Facades\Mail;
use Sentinel;

class RegisterController extends Controller
{
    public function register(){
        $data = RoleModel::get();
        return view('security.register',['data'=>$data]);
    }
    public function createUser(Request $request){
          request()->validate([
              'name'=>'required',
              'email'=>'required',
              'password'=>'required',
              'role'=>'required',

          ]);
         $roleID = request('role');

         $user =  Sentinel::register($request->all());

         $role = Sentinel::findRoleByID($roleID);
         $role->users()->attach($user);

        $activate = Activation::create($user);
        $this->SendActivationEmail($user,$activate->code);

        return redirect('/');
    }

    public function SendActivationEmail($user,$code){
        Mail::send(
            'email.activation',
            ['user'=>$user,'code'=>$code],
            function ($message) use ($user){
                $message->to($user->email);
                $message->subject("Hello $user->name","Activate your Account .");
            }
        );
    }
}
