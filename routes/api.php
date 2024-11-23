<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

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
Route::post("/", [UserController::class, "authenticate"]);
Route::post("/get_user", [UserController::class, "get_user"]);

Route::prefix("/admin")->group(function() {
    Route::prefix("/news")->group(function() {
        Route::get("/{id?}", [NewsController::class, "get_news"]);
        Route::post("/", [NewsController::class, "add_news"]);
        Route::put("/{id}", [NewsController::class, "update_news"]);
        Route::delete("/{id}", [NewsController::class, "delete_news"]);
    });
});

