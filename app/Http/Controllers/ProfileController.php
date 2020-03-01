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
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'about' => ['required', 'string', 'max:255'],
                    'course' => ['required', 'string', 'max:255'],
                ]);
                $user = Auth::user();
                $avatarName = $user->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('avatars', $avatarName);

                $user->avatar = $avatarName;
                $user->save();
            } else {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'about' => ['required', 'string', 'max:255'],
                    'course' => ['required', 'string', 'max:255'],
                ]);
            }

            $update = User::whereId(Auth::id())->update([
                'email' => $email,
                'course' => $course,
                'about' => $about,
            ]);
            return redirect('/profile');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('generic-message-view', ['message' => $message]);
        }
    }
}