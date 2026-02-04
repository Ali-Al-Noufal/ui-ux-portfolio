<?php

use App\Http\Controllers\api\Authcontroller;
use App\Http\Controllers\api\Messagecontroller;
use App\Http\Controllers\api\Projectcontroller;
use App\Http\Controllers\api\Skillrcontroller;
use App\Http\Controllers\api\Testemonialcontroller;
use App\Http\Controllers\api\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::post('/',[Authcontroller::class,'login']);
//..................................................
Route::get('/guest/users/{id}',[Usercontroller::class,'show']);
//..........................................................
Route::get('/guest/skills',[Skillrcontroller::class,'index']);
Route::get('/guest/skills/{id}',[Skillrcontroller::class,'show']);
//............................................................
Route::post('/guest/{user}/messages',[Messagecontroller::class,'store']);
//..........................................................
Route::get('/guest/projects',[Projectcontroller::class,'index']);
Route::get('/guest/projects/{id}',[Projectcontroller::class,'show']);
//...........................................................
Route::get('/guest/testemonials',[Testemonialcontroller::class,'index']);
//...........................................................
//...........................................................
//...........................................................
Route::middleware(['auth:sanctum'])->group(function(){
Route::get('/messages',[Messagecontroller::class,'index']);
Route::get('/messages/{id}',[Messagecontroller::class,'show']);
Route::delete('/messages/{id}',[Messagecontroller::class,'destroy']);
//...................................................
Route::get('/projects',[Projectcontroller::class,'index']);
Route::post('/projects',[Projectcontroller::class,'store']);
Route::get('/projects/{id}',[Projectcontroller::class,'show']);
Route::put('/projects/{id}',[Projectcontroller::class,'update']);
Route::delete('/projects/{id}',[Projectcontroller::class,'destroy']);
//..................................................
Route::get('/skills',[Skillrcontroller::class,'index']);
Route::post('/skills',[Skillrcontroller::class,'store']);
Route::get('/skills/{id}',[Skillrcontroller::class,'show']);
Route::put('/skills/{id}',[Skillrcontroller::class,'update']);
Route::delete('/skills/{id}',[Skillrcontroller::class,'destroy']);
//..................................................
Route::get('/testemonials',[Testemonialcontroller::class,'index']);
Route::post('/testemonials',[Testemonialcontroller::class,'store']);
Route::delete('/testemonials/{id}',[Testemonialcontroller::class,'destroy']);
//..................................................
Route::put('/user/{user}/edit',[Usercontroller::class,'update']);
//..................................................
Route::post('/logout',[Authcontroller::class,'logout']);
});
