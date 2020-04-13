<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    //
    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('public.home');
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('public.contact');
    }
}
