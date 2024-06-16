<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\shortController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/links', [shortController::class, 'index']);
Route::post('/links', [shortController::class, 'createLink']);

Route::delete('/links/delete/{id}', [shortController::class, 'delete']);

