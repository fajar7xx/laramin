<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::apiResource('books', 'Api\BookController');
Route::apiResource('categories', 'Api\CategoryController');

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('user', function(Request $request){
        return $request->user();
    });
    
    Route::get('tes', function(){
        $teks = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia voluptatem, totam quia ipsa repellendus, cum ex vel vero animi eveniet voluptas quidem ducimus. Illum et aspernatur repudiandae alias dicta dolorum!';
        return response()->json([
            'pesan' => 'Berhasil masuk',
            'teks' => $teks
        ], 200);
    });
    
    Route::post('logout', 'Api\AuthController@logout');
});
