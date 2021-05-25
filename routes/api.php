<?php

use App\Http\Controllers\GovernmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;

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

Route::middleware(['cors'])->group(function () {
    Route::post('/add-government', [GovernmentController::class, 'store']);
    Route::get('/addresses/user/{id}', [AddressController::class, 'showUserAddresses', '{id}']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::post('/add-user', [UserController::class, 'store']);
    Route::get('/count-users', [UserController::class, 'getCount']);
    Route::get('/count-governments', [GovernmentController::class, 'getCount']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



