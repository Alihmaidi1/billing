<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){ 
    

    Route::get('/display_bill',"App\Http\Controllers\billing@index")->middleware('auth')->middleware('verified');
    Route::get('/create_bill',"App\Http\Controllers\billing@create")->middleware('auth')->middleware('verified');
    Route::post('/store_bill',"App\Http\Controllers\billing@store")->middleware('auth')->middleware('verified');
    Route::get("/del_invoice","App\Http\Controllers\billing@destroy")->middleware('auth')->middleware('verified');
    Route::get('/invoice/show/{id}',"App\Http\Controllers\billing@show")->middleware('auth')->middleware('verified');
    Route::get("/invoice/edit/{id}","App\Http\Controllers\billing@edit")->middleware('auth')->middleware('verified');
    Route::post('/update_bill',"App\Http\Controllers\billing@update")->middleware('auth')->middleware('verified');
    Route::get("/print/{id}","App\Http\Controllers\billing@print")->middleware('auth')->middleware('verified');
    Route::get("/sendmail/{id}","App\Http\Controllers\billing@sendemail")->middleware('auth')->middleware('verified');
    Route::get('/',"App\Http\Controllers\billing@index")->middleware('verified');
    Route::get("/logout",function(){
    
    Session::flush();
    Auth::logout();
    return redirect("login");


    });
    Auth::routes(['verify'=>true]); 
    Route::get('/home',"App\Http\Controllers\billing@index")->middleware('verified')->name('home');
    
});


?>