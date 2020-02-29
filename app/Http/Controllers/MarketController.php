<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;

class MarketController extends Controller
{
    //
    public function index()
    {
        $variables = Market::all();
        return view('market-view', ['variables' => $variables]);
    }
}