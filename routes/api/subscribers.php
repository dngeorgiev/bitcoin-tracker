<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Subscribers\StoreController;

Route::group([], function() {
    Route::post('/', StoreController::class)->name('store');
});
