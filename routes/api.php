<?php

use Illuminate\Support\Facades\Route;
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
    Route::post("/", [FormController::class, 'createForm']);
    Route::get("/{form}", [FormController::class, 'showForm']);
    Route::post("/{form}/addquestion", [FormController::class, 'addQuestion']);
    Route::delete("/{form}/deletequestion/{id}", [FormController::class, 'deleteQuestion']);
    Route::get("/{form}/showapplicants/{id}", [
        FormController::class,
        'showApplicant'
    ]);
    Route::get("/{form}/showapplicants", [
        FormController::class,
        'showApplicants'
    ]);
    Route::post("/{form}/submitanswers", [FormController::class, 'submitAnswers'])->middleware(['throttle:1,2']);
});
