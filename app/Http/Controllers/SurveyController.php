<?php

namespace App\Http\Controllers;

use App\GenerateCharts;
use App\Survey;
use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $surveys = Survey::where('creator_id', '!=', Auth::id())->orderBy('created_at', 'desc')->paginate(6);

        return view('survey-listing', ['surveys' => $surveys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('edit-survey', ['categories' => $categories]);
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
        $json = \json_decode($data, true);
        $formData = \json_encode($json['json']);
        $survey = Survey::create([
            'form_data' => $formData,
            'creator_id' => Auth::id(),
            'category' => $json['category'],
            'survey_title' => $json['title'],
            'survey_description' => $json['description']
        ]);
        if ($survey->exists()) {
            return response('success', 200)->header('Content-Type', 'text/plain');
        }
        //@codeCoverageIgnoreStart
        else {
            return response('fail', 400)->header('Content-Type', 'text/plain');
        }
        //@codeCoverageIgnoreStop
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Collect all responses to survey
        $responses = Response::where('id_survey', $id)->get();
        $data = [];
        if ($responses->count()) {
            //Decode the json to arrays
            foreach ($responses as $response) {
                array_push($data, json_decode($response->response));
            }
            $nameAndData = [];
            $numElements = count($data[0]);
            $arr = [];

            //Create and array with the array keys as the name of the input, so we can then sum all responses for the question
            foreach ($data as $dat) {
                for ($i = 0; $i < $numElements; $i++) {
                    if (property_exists($dat[$i], 'name')) {
                        $nameAndData[$dat[$i]->name] = array($dat[$i]->type, array());
                    }
                }
            }

            //Push the user data to the created array
            foreach ($data as $dat) {
                for ($i = 0; $i < $numElements; $i++) {
                    if (property_exists($dat[$i], 'name')) {
                        if (array_key_exists($dat[$i]->name, $nameAndData)) {
                            $nameAndData[$dat[$i]->name][1][0][] = $dat[$i]->userData;
                        }
                    }
                }
            }

            //Genereate the charts that display the data.
            $charts = new GenerateCharts();
            $charts = $charts->GenerateCharts($nameAndData);
        } else {
            $charts = 'No results yet';
        }

        return response()->view('response-data-view', ['charts' => $charts], 200);
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
}