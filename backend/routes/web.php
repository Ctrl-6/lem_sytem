<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstalationController;
use App\Http\Controllers\RegistroController;

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


Route::post('/instalation/add',[InstalationController::class,'store']);
Route::get('/instalation/tecnicoid/{tecnicoid}',[InstalationController::class,'get_tecnicoid']);
Route::get('/instalation/equipos/all',[InstalationController::class,'get_equipos']); 


Route::post('/support/add',[RegistroController::class,'storeHistory']);
Route::get('/support/history/{id}',[RegistroController::class,'get_history']);
Route::get('/support/all',[RegistroController::class,'get_all']);
Route::get('/support/{id}',[RegistroController::class,'get_id']);
Route::put('/support/{id}',[RegistroController::class,'update']);
Route::get('/support/status/{status}',[RegistroController::class,'get_status']);









