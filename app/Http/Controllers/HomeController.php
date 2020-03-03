<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //
    public function index()
    {

        return view('public.home');
    }
    public function about()
    {
        return view('public.about');
    }
    public function contact()
    {
        return view('public.contact');
    }
}