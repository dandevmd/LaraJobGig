<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ListingController::class, 'index']);
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
Route::get('/listings/{listing}', [ListingController::class, 'show']);
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
Route::get('/dashboard', [ListingController::class, 'dashboard'])->middleware('auth');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}/update', [ListingController::class, 'update'])->middleware('auth');
Route::delete('/listings/{listing}/delete', [ListingController::class, 'destroy'])->middleware('auth');


Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register/store', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login/store', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');