<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('getdata', [ApiController::class, 'getData']);
Route::post('savedata', [ApiController::class, 'storeData']);
Route::put('updatedata', [ApiController::class, 'updateData']);
Route::delete('delete/{id}', [ApiController::class, 'deleteData']);
Route::get('search/{name}', [ApiController::class, 'searchData']);