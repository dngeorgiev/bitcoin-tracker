<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('subscribers')
    ->name('subscribers.')
    ->group(base_path('routes/api/subscribers.php'));
Route::prefix('ticker_data')
    ->name('ticker_data.')
    ->group(base_path('routes/api/ticker_data.php'));
