<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('logout','security\loginController@logout');

Route::group(['middleware'=>'visitor'],function (){

    Route::get('register','security\RegisterController@register');
    Route::post('register','security\RegisterController@createUser');
    Route::get('login','security\loginController@login');
    Route::post('login','security\loginController@postlogin');

    Route::get('/Activate/{email}/{code}','security\ActivatController@activate');
    Route::get('forgetpassword','security\ForgetPasswordController@forgetpass');
    Route::post('forgetpassword','security\ForgetPasswordController@password');

    Route::get('resetPassword/{email}/{code}','security\ForgetPasswordController@resetpassword');
    Route::post('resetPassword/{email}/{code}','security\ForgetPasswordController@reset');


});





Route::group(['middleware'=>'admin'],function (){

    Route::get('reports','Reports\ReportController@report');

});

Route::get('form','Form\FormController@form');

Route::get('permission','security\permissionController@assign');

Route::post('permission','security\permissionController@assignpermission');

Route::get('excel','test\testController@excele');
Route::post('excel','test\testController@importexcele');