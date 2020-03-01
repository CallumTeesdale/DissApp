<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Response;
use Illuminate\Http\Request;
use App\ContractInteractions;
use App\EthPersonal;
use Illuminate\Support\Facades\Auth;
use App\User;

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
    $contractOwner = '0x90F8bf6A479f320ead074411a4B0e7944Ea8c9C1';
    $data = $request->getContent();
    $decode = \json_decode($data, true);
    $userData = \json_encode($decode['userData']);

    $response = Response::create([
      'id_survey' => $decode['survey_id'],
      'response' => $userData,
      'user_id' => Auth::id()
    ]);

    if ($response->exists()) {
      $contract = new ContractInteractions();
      $contract->transfer(
        Auth::user()->public_key,
        $contractOwner,
        '123456',
        100
      );

      return response('success', 200)->header('Content-Type', 'text/plain');
    }
    // @codeCoverageIgnoreStart
    else {
      return response('fail', 400)->header('Content-Type', 'text/plain');
    }
    // @codeCoverageIgnoreStop
  }

  public function show($id)
  {
    $survey = Survey::find($id);
    $user = User::where('id', $survey->creator_id)->first();
    $responses = Response::where('id_survey', $id)->get();
    $exists = $responses->where('user_id', Auth::id());
    if ($exists->count()) {
      $message = 'You can\'t answer the same survey more than once';
      return view('survey-response-fail', ['message' => $message]);
    } else {
      return response()->view(
        'render-survey',
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