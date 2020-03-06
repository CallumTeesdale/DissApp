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

        /**
         *  * Get a list of all the surveys the user has all ready responded to
         */
        $response = Response::all();
        $arrR_id = [];
        foreach ($response as $r) {
            if ($r->user_id === Auth::id()) {
                array_push($arrR_id, $r->survey_id); //@codeCoverageIgnore
            }
        }

        /**
         * * Don't allow creator to find their own surveys
         */
        $surveys = Survey::where('user_id', '!=', Auth::id())->orderBy('created_at', 'desc')->get();


        /**
         *  * Return with the surveys that aren't the creator logged in or the user hasn't answered
         */
        return view('surveys.survey-listing', ['surveys' => $surveys->except($arrR_id)->paginate(6)]);
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
        return view('surveys.edit-survey', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->getContent();
        $json = \json_decode($data, true);
        $formData = \json_encode($json['json']);
        $survey = Survey::create([
            'form_data' => $formData,
            'user_id' => Auth::id(),
            'category' => $json['category'],
            'survey_title' => $json['title'],
            'survey_description' => $json['description']
        ]);

        /**
         * * If the saving to database was succesful
         */
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
        $responses = Response::where('survey_id', $id)->get();
        $data = [];
        if ($responses->count()) {


            /**
             * * Decode Json to arrays
             */
            foreach ($responses as $response) {
                array_push($data, json_decode($response->response));
            }
            $nameAndData = [];
            $numElements = count($data[0]);
            $arr = [];

            /**
             * * Create and array with the array keys as the name of the input, so we can then sum all responses for the question
             */
            foreach ($data as $dat) {
                for ($i = 0; $i < $numElements; $i++) {
                    if (property_exists($dat[$i], 'name')) {
                        $nameAndData[$dat[$i]->name] = array($dat[$i]->type, array());
                    }
                }
            }

            /**
             * * Push the user data to the created array
             */
            foreach ($data as $dat) {
                for ($i = 0; $i < $numElements; $i++) {
                    if (property_exists($dat[$i], 'name')) {
                        if (array_key_exists($dat[$i]->name, $nameAndData)) {
                            $nameAndData[$dat[$i]->name][1][0][] = $dat[$i]->userData;
                        }
                    }
                }
            }

            /**
             * * Genereate the charts that display the data.
             */
            $charts = new GenerateCharts();
            $charts = $charts->GenerateCharts($nameAndData);

            /**
             * * If no responses yet
             */
        } else {
            $charts = 'No results yet';
        }

        return response()->view('surveys.response-data-view', ['charts' => $charts], 200);
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
        $survey = Survey::where('id', $id)->get()->first();
        if (Auth::id() == $survey->user_id) {
            $survey->delete();
        }
        return \redirect('/profile');
    }
}
