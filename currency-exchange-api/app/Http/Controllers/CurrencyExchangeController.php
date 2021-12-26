<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyExchangeService; 


class CurrencyExchangeController extends Controller
{
    public function getCurrencies(Request $request)
    {
        $service = new CurrencyExchangeService($request->query('access_key'));
        return $service->getCurrencies($request);
    }

    public function exchange(Request $request)
    {
        $service = new CurrencyExchangeService($request->query('access_key'));
        return $service->exchange($request);
    }
}
