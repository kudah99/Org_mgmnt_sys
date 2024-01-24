<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;
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

Route::get('/',[MemberController::class,'index'])->name('home');
Route::post('/save', [MemberController::class, 'store'])->name('validate.form');
// Route::get('/login', [MemberController::class, 'login'])->name('login');
// Route::get('login-submit', [MemberController::class, 'login-submit'])->name('login-submit');