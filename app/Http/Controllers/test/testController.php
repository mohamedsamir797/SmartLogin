<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function excele(){
        return view('excel.form');
    }

    public function importexcele(Request $request){

        request()->validate([
            'file'=>'required|max:5000|mimes:xlsx,xls,cs'
        ]);


        $filename =$request->file('file')->getClientOriginalName();
        $request->file('file')->move('uploads',$filename);

    }
}
