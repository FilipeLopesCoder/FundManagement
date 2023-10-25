<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FundsController;

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

Route::middleware('auth:sanctum')->get('/funds', function (Request $request) {
    response('the response', 200);
});

Route::get('/funds/', [FundsController::class, 'list']);
Route::get('/funds/{id}', [FundsController::class, 'single']);
Route::put('/funds/{id}', [FundsController::class, 'edit']);
Route::post('/funds/create', [FundsController::class, 'create']);
