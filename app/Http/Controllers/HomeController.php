<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //
<<<<<<< HEAD
    /**
     * @return Factory|\Illuminate\View\View
     */
=======
>>>>>>> parent of dcfb3a9... More phpdocs
    public function index()
    {

        return view('public.home');
    }
<<<<<<< HEAD

    /**
     * @return Factory|\Illuminate\View\View
     */
=======
>>>>>>> parent of dcfb3a9... More phpdocs
    public function about()
    {
        return view('public.about');
    }
<<<<<<< HEAD

    /**
     * @return Factory|\Illuminate\View\View
     */
=======
>>>>>>> parent of dcfb3a9... More phpdocs
    public function contact()
    {
        return view('public.contact');
    }
}