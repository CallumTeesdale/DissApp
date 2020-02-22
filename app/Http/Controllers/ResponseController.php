<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Response;
use Illuminate\Http\Request;
use App\ContractInteractions;
use App\EthPersonal;
use Illuminate\Support\Facades\Auth;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->getContent();
        $decode = \json_decode($data, true);
        $var = var_export($decode, true);
        file_put_contents('decode.txt', $var);
        $userData = \json_encode($decode['userData']);

        $response = Response::create([
            'id_survey' => $decode['survey_id'],
            'response' => $userData,
            'user_id' => Auth::id(),
        ]);

        if ($response->exists()) {
            $contract = new ContractInteractions();
            $contract->transfer(Auth::user()->public_key, 100);
            return response('success', 200)
                ->header('Content-Type', 'text/plain');
        } else {
            return response('fail', 400)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $survey = Survey::find($id);
        return response()->view('render-survey', ['survey' => $survey], 200);
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
     * @param  \Illuminate\Http\Request  $request
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

    public function success()
    {
        return view('survey-response-success');
    }
    public function fail()
    {
        return view('survey-response-fail');
    }
}