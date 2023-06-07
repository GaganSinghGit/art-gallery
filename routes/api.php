<?php

use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\ArtGalleryController;
use App\Http\Controllers\ExhibitionController;
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

Route::get('/artifact', [ArtifactController::class, 'index'])->name('get-artifacts');
Route::post('/artifact', [ArtifactController::class, 'store'])->name('create-artifact')->middleware('auth:sanctum');
Route::put('/artifact/{artifact}', [ArtifactController::class, 'update'])->name('update-artifact')->middleware('auth:sanctum');
Route::delete('/artifact/{artifact}', [ArtifactController::class, 'destroy'])->name('delete-artifact')->middleware('auth:sanctum');
Route::get('/my-artifacts', [ArtifactController::class, 'myArtifacts'])->name('my-artifacts')->middleware('auth:sanctum');

Route::post('/create-art-gallery', [ArtGalleryController::class, 'store'])->name('create-art-gallery')->middleware('auth:sanctum');

Route::get('/get-exhibitions', [ExhibitionController::class, 'index'])->name('get-exhibitions')->middleware('auth:sanctum');
Route::post('/create-exhibition', [ExhibitionController::class, 'store'])->name('create-exhibition')->middleware('auth:sanctum');
Route::put('/update-exhibition/{exhibition}', [ExhibitionController::class, 'update'])->name('update-exhibition')->middleware('auth:sanctum');
Route::delete('/delete-exhibition/{exhibition}', [ExhibitionController::class, 'destroy'])->name('delete-exhibition')->middleware('auth:sanctum');
Route::get('/get-exhibitions-with-artifacts', [ExhibitionController::class, 'getExhibitionsWithArtifacts'])->name('get-exhibitions-with-artifacts');

Route::post('/add-artifact-to-exhibition/{exhibition}', [ExhibitionController::class, 'addArtifact'])->name('add-artifact-to-exhibition')->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
