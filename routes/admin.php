<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CandidatController;
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
    //
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum','2fa')->name('dashboard');
    Route::resource('admin/pays', PaysController::class);
    Route::resource('admin/edition', EditionController::class);
    Route::resource('admin/filiale', FilialeController::class);
    Route::resource('admin/partenaire', PartenaireController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/candidats', CandidatController::class);

    Route::put('admin/candidats/preselection/{id}', [CandidatController::class, 'preselection'])->name('candidats.preselection');
    
})->middleware('auth:sanctum','can:isAdmin','2fa');

