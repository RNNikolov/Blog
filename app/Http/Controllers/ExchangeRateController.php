<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Models\Post;
use Session;

class ExchangeRateController extends Controller
{
    public function index(ExchangeRate $api)
    {
        $rates = $api->getRates();
        return view('currency', compact('rates'));
    }
}
