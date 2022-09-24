<?php

use App\Http\Controllers\Api\Subscribers\StoreController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::post('/', StoreController::class)->name('store');
});
