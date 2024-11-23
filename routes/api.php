<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArticleController;
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

Route::prefix("/news")->group(function() {
    Route::get("/{id?}", [NewsController::class, "get_news"]);
    Route::post("/", [NewsController::class, "add_news"]);
    Route::put("/{id}", [NewsController::class, "update_news"]);
});
Route::prefix("/article")->group(function() {
    Route::get("/{news_id}/{id?}", [ArticleController::class, "get_article"]);
    Route::post("/", [ArticleController::class, "add_article"]);
});

Route::prefix("/admin")->group(function() {
    Route::prefix("/news")->group(function() {
        Route::get("/{id?}", [NewsController::class, "get_news"]);
        Route::post("/", [NewsController::class, "add_news"]);
        Route::put("/{id}", [NewsController::class, "update_news"]);
        Route::delete("/{id}", [NewsController::class, "delete_news"]);
    });
});

