<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Survey;
use App\User;
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
    public function getProfileEdit()
    {
        $user = User::where('id', Auth::id())->first();
        return view('edit-profile-form', ['user' => $user]);
    }
    public function postProfileEdit(Request $request)
    {
        $email = $request->input('email');
        $course = $request->input('course');
        $about = $request->input('about');
        try {
            $update = User::whereId(Auth::id())->update([
                'email' => $email,
                'course' => $course,
                'about' => $about,
            ]);
            return $this->getProfile();
        } catch (\Exception $e) {
            $message = 'Error updating profile';
            return view('survey-response-fail', ['message' => $message]);
        }
    }
}