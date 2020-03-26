<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Sentinel;
use Activation;


class ActivatController extends Controller
{
    public function activate($email,$code){

        $user = User::whereEmail($email)->first();
        $user = Sentinel::findById($user->id);
        if (Activation::complete($user,$code)){
            return redirect('/login');
        }
    }
}
