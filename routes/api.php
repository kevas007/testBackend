<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/api')->group(function () {
    Route::apiResource('depense', 'exampleController');
});
