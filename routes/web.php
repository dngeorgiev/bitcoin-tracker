<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Used only to initiate Vue.js app
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('app');
});
