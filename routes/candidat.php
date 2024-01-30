<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CandidatureController;
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


Route::group(['namespace' => 'App\Http\Controllers'], function()
{ 
    Route::resource('candidat/candidature', CandidatureController::class);
    Route::get('candidat/dashboard', [CandidatureController::class,'index'])->middleware(['auth', 'verified','2fa','can:isCandidat'])->name('candidat');
    Route::delete('candidat/media/{uuid}', [CandidatureController::class,'delete'])->name('candidat.media');
    Route::put('candidat/validate/{candidature}', [CandidatureController::class, 'validation'])->name('candidats.validation');
   
})->middleware('candidat');

Route::middleware('guest')->group(function () {
Route::get('register-candidat', [RegisteredUserController::class, 'candidatView'])->name('getcandidat-view');
Route::post('register-candidat', [RegisteredUserController::class, 'registerCandidat'])->name('postcandidat-register');
});
