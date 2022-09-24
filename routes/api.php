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
