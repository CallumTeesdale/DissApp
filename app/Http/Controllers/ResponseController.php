<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Response;
use Illuminate\Http\Request;
use App\ContractInteractions;
use App\EthPersonal;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;
use function json_decode;
use function json_encode;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * * Set the contract owner and decode the json from the ajax submission
         */

        $contractOwner = '0x90F8bf6A479f320ead074411a4B0e7944Ea8c9C1';
        $data = $request->getContent();
        $decode = json_decode($data, true);
        $userData = json_encode($decode['userData']);


        /**
         * * Save the data
         */
        $response = Response::create([
            'survey_id' => $decode['survey_id'],
            'response' => $userData,
            'user_id' => Auth::id()
        ]);

        /**
         * *If saved succesfuly deposit the tokens
         */
        if ($response->exists()) {

            try {
                $contract = new ContractInteractions();
                $contract->transfer(
                    Auth::user()->public_key,
                    $contractOwner,
                    '123456',
                    100
                );
            }
            // @codeCoverageIgnoreStart
            catch (Exception $e) {
                /**
                 * * Handle the error if the transfer failed
                 */
            }
            // @codeCoverageIgnoreStop

            /**
             * * Tell the browser that everything succeeded
             */
            return response('success', 200)->header('Content-Type', 'text/plain');
        }
        // @codeCoverageIgnoreStart
        else {
            return response('fail', 400)->header('Content-Type', 'text/plain');
        }
        // @codeCoverageIgnoreStop
    }

    /**
     * * Show the rendered survey
     */
    public function show($id)
    {
        /**
         * * Get the survey, the user who created the survey, and any responses to the survey
         */
        $survey = Survey::find($id);
        $user = User::where('id', $survey->user_id)->first();
        $responses = Response::where('survey_id', $id)->get();

        /**
         * * Check whether the logged in user has all ready answered the survey
         */
        $exists = $responses->where('user_id', Auth::id());

        /**
         * * If the logged in user all ready answered then redirect them
         */
        if ($exists->count()) {
            $message = 'You can\'t answer the same survey more than once';
            return view('response.survey-response-fail', ['message' => $message]);
        } elseif (Auth::id() == $survey->user_id) {

            /**
             * * If the user trying to access the rendered survey is the creator, redirect them
             */
            $message = 'You can\'t answer your own';
            return view('response.survey-response-fail', ['message' => $message]);
        } else {
            /**
             * * If all checks pass then render the survey
             */
            return response()->view(
                'response.render-survey',
                ['survey' => $survey, 'user' => $user],
                200
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * * Display the success page
     */
    public function success()
    {
        return view('response.survey-response-success');
    }

    /**
     * * Display the fail page
     */
    public function fail()
    {
        return view('response.survey-response-fail');
    }
}
