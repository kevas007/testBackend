<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    Route::apiResource('depense', '\App\Http\Controllers\API\DepenseController');
    Route::apiResource('categorie', '\App\Http\Controllers\API\CategorieController');
    Route::get("state",[\App\Http\Controllers\API\CategorieController::class,'getState']);
});
