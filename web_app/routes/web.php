<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\MemberContribution\MemberContributionController;
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

Route::get('/',[MemberController::class,'view_index'])->name('home');
Route::post('/save_member', [MemberController::class, 'view_store'])->name('validate.form');
Route::post('/save_contribution', [MemberContributionController::class, 'view_store'])->name('validate.form_1');