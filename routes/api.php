<?php

use App\Http\Controllers\API\Package\ApacheController;
use App\Http\Controllers\API\Package\PackageCentreController;
use App\Http\Controllers\API\Shell\ShellCommandController;
use App\Http\Controllers\Auth;
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

Route::middleware('auth:api')->get('/user', [Auth\UserController::class, 'user']);

Route::post('login', [Auth\UserController::class, 'login']);
Route::apiResource('users', Auth\UserController::class);
Route::post('users/forgot-password', [Auth\UserController::class, 'forgotPassword']);
Route::post('users/reset-password', [Auth\UserController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('auth:sanctum')->post('logout', [Auth\UserController::class, 'logout']);
    Route::apiResources([
        'galleries' => GalleryController::class,
        'photos' => PhotoController::class,
        'paths' => PathController::class,
    ]);
    Route::patch('rename/{photo}', [PhotoController::class, 'rename']);
    Route::patch('exif/{photo}', [PhotoController::class, 'exif']);

    Route::post('packages/test', [PackageCentreController::class, 'test']);
    Route::post('packages/install', [PackageCentreController::class, 'install']);
    Route::post('packages/remove', [PackageCentreController::class, 'remove']);
    Route::apiResource('packages', PackageCentreController::class);

    Route::prefix('package')->group(function () {
        Route::prefix('apache')->group(function () {
            Route::get('list-envs', [ApacheController::class, 'listEnvs']);
            Route::get('get-file', [ApacheController::class, 'getFile']);
            Route::post('update-file', [ApacheController::class, 'updateFile']);
        });
    });
    Route::post('shell/run', [ShellCommandController::class, 'run']);
});

// });
