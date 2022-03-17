<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SwaggerController;
use App\Http\Controllers\ModelController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>['auth:sanctum']],function () {
    Route::post('/getUserById', [UserController::class, 'getUserById']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/createProject', [ImportController::class, 'createProject']);
});
Route::post('/import', [ImportController::class, 'import']);

Route::post('/importSingleModel', [ModelController::class, 'importSingleModel']);
Route::get('/getAllModels', [ModelController::class, 'getAllModels']);
Route::post('/deleteModel', [ModelController::class, 'delete']);


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::post('/get', [SwaggerController::class, 'get']);
