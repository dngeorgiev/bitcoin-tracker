<?php

use App\Http\Controllers\Api\TickerData\IndexController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/{fromCurrency}/{toCurrency}/{chartType?}', IndexController::class)->name('index');
});
