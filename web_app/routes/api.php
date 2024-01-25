<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\MemberContribution\MemberContributionController;
use App\Http\Controllers\UserAuthenticationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::get('members/{id}', [MemberController::class, 'show'])->name('members.show');
    Route::post('members', [MemberController::class, 'store'])->name('members.store');
    Route::put('members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::get('members_contribution', [MemberContributionController::class, 'index'])->name('members_contribution.index');
    Route::get('members_contribution/{id}', [MemberContributionController::class, 'show'])->name('members_contribution.show');
    Route::post('members_contribution', [MemberContributionController::class, 'store'])->name('members_contribution.store');
    Route::put('members_contribution/{id}', [MemberContributionController::class, 'update'])->name('members_contribution.update');
    Route::delete('members_contribution/{id}', [MemberContributionController::class, 'destroy'])->name('members_contribution.destroy');
    
    Route::post('login', [UserAuthenticationController::class, 'login']);
    Route::post('register', [UserAuthenticationController::class, 'register']);
    Route::post('logout', [UserAuthenticationController::class, 'logout'])->middleware('auth:sanctum');
    
});

