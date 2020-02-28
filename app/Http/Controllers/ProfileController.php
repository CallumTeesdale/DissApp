<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Survey;
use App\ContractInteractions;


class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProfile()
    {
        $contract = new ContractInteractions();
        $balance = $contract->contractGetBalance(Auth::user()->public_key);
        $surveys = Survey::where('creator_id', Auth::id())->get()->sortByDesc('created_at');
        return response()->view('profile', ['surveys' => $surveys, 'balance' => $balance], 200);
    }
}