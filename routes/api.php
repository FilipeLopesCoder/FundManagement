<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\FundManagersController;
use App\Http\Controllers\CompanyController;

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

Route::get('/fundmanagers/', [FundManagersController::class, 'list']);
Route::get('/fundmanagers/{id}', [FundManagersController::class, 'single']);
Route::put('/fundmanagers/{id}', [FundManagersController::class, 'edit']);
Route::post('/fundmanagers/create', [FundManagersController::class, 'create']);

Route::get('/companies/', [CompanyController::class, 'list']);
Route::get('/company/{id}', [CompanyController::class, 'single']);
Route::put('/company/{id}', [CompanyController::class, 'edit']);
Route::post('/company/create', [CompanyController::class, 'create']);
