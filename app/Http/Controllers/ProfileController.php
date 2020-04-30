<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Survey;
use App\Response;
use App\User;
use App\ContractInteractions;


/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
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
        /**
         * * Get the balance of the user and all the surveys they created
         */
        $contract = new ContractInteractions();
        $balance = $contract->contractGetBalance(Auth::user()->public_key);
        $surveys = Survey::where('user_id', Auth::id())->get()->sortByDesc('created_at');
        $responses_count = [];

        foreach ($surveys as $surv) {
            $responses_count[$surv->id] = count(Response::where('survey_id', $surv->id)->get());
        }

        return response()->view('profile.profile', ['surveys' => $surveys, 'balance' => $balance, 'responses_count' => $responses_count], 200);
    }

    /**
     * * Display the edit profile form
     */
    public function getProfileEdit()
    {
        $user = User::where('id', Auth::id())->first();
        return view('profile.edit-profile-form', ['user' => $user]);
    }

    /**
     * * Save the edited profile
     */
    public function postProfileEdit(Request $request)
    {
        $email = $request->input('email');
        $course = $request->input('course');
        $about = $request->input('about');
        try {

            /**
             * * If the user change their photo upload and save it
             */
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

                /**
                 * * User didn't upload a photo validate the rest
                 */
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'about' => ['required', 'string', 'max:255'],
                    'course' => ['required', 'string', 'max:255'],
                ]);
            }

            /**
             * * Save the update
             */
            $update = User::whereId(Auth::id())->update([
                'email' => $email,
                'course' => $course,
                'about' => $about,
            ]);

            return redirect('/profile');
        } catch (\Exception $e) {
            /**
             * * Catch any errors
             */
            $message = $e->getMessage();
            return view('generic-message-view', ['message' => $message]);
        }
    }

    /**
     * * Delete the account
     */

    public function deleteProfile($id)
    {
        if (Auth::id() == $id) {
            $account = User::whereId(Auth::id())->get()->first();
            $account->delete();
            return \redirect('/');
        }
        return \redirect('/profile');
    }
}