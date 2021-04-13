<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;

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


Route::group(['prefix' => 'form'], function () {
    Route::get("/", [FormController::class, 'showAll']);
    Route::post("/", [FormController::class, 'createForm'])->middleware('auth:sanctum');
    Route::get("/{form}", [FormController::class, 'showForm']);
    Route::post("/{form}/addquestion", [FormController::class, 'addQuestion'])->middleware('auth:sanctum');
    Route::delete("/{form}/deletequestion/{id}", [FormController::class, 'deleteQuestion'])->middleware('auth:sanctum');
    Route::get("/{form}/showapplicants/{id}", [
        FormController::class,
        'showApplicant'
    ])->middleware('auth:sanctum');
    Route::get("/{form}/showapplicants", [
        FormController::class,
        'showApplicants'
    ])->middleware('auth:sanctum');
    Route::post("/{form}/submitanswers", [FormController::class, 'submitAnswers'])->middleware(['throttle:1,2']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
