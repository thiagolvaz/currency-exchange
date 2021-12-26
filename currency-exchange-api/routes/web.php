<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyExchangeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/v1/currencies', [CurrencyExchangeController::class, 'getCurrencies']);
Route::get('/api/v1/currencies/exchange', [CurrencyExchangeController::class, 'exchange']);