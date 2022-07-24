<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/buku',[BookController::class, 'index']); //MENGAMBIL DATA
Route::post('/buku/store',[BookController::class, 'store']); //
Route::get('/buku/show/{id}',[BookController::class, 'show']); //
Route::put('/buku/update/{id}',[BookController::class, 'update']); //
Route::delete('/buku/destroy/{id}',[BookController::class, 'destroy']); //