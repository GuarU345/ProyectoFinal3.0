<?php

use App\Http\Controllers\AdafruitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('/mandatemp',[AdafruitController::class,'RegistrarTemp']);
    Route::get('/mandahum',[AdafruitController::class,'RegistrarHum']);
    Route::get('/mandaultra',[AdafruitController::class,'RegistrarUltra']);
    Route::get('/mandaled',[AdafruitController::class,'RegistrarLed']);
    Route::get('/consultatemp',[AdafruitController::class,'consulta1']);
    Route::get('/consultahum',[AdafruitController::class,'consulta2']);
    Route::get('/consultaultra',[AdafruitController::class,'consulta3']);

    Route::get('/consultatempmin',[AdafruitController::class,'ConsultaTemp']);
    Route::get('/consultatempmax',[AdafruitController::class,'ConsultaTemp2']);
    Route::get('/consultatemprom',[AdafruitController::class,'ConsultaTemp3']);
    Route::get('/consultahummax',[AdafruitController::class,'ConsultaHum']);
    Route::get('/consultahummin',[AdafruitController::class,'ConsultaHum2']);
    Route::get('/consultaultramax',[AdafruitController::class,'ConsultaUltra']);
    Route::get('/consultaultraprom',[AdafruitController::class,'ConsultaUltra2']);
    Route::get('/consultaled',[AdafruitController::class,'ConsultaLed']);

});
