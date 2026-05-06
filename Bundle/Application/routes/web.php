<?php

use App\Http\Controllers\Dev\DevController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dev'], function () {
    Route::get('/', [DevController::class, 'sandbox']);
});
