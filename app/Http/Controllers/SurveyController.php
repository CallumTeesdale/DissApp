<?php

namespace App\Http\Controllers;

use app\GenerateCharts;
use App\Survey;
use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('edit-survey');
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
        $jsondata = $request;
        $json =  \json_decode($jsondata['json_']);
        $json = \json_encode($json);
        $survey = Survey::create([
            'form_data' => $jsondata['json_'],
            'creator_id' => Auth::id(),
            'category' => 1,
            'survey_title' => 'title',
            'survey_description' => 'desc',
        ]);
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
        include($_SERVER['DOCUMENT_ROOT'] . '/../app/GenerateCharts.php');
        $responses = Response::where('id_survey', $id)->get();
        $data = [];
        foreach ($responses as $response) {
            array_push($data, json_decode($response->response));
        }
        $nameAndData = [];
        $numElements = count($data);
        $arr = [];
        foreach ($data as $dat) {
            for ($i = 0; $i <= $numElements; $i++) {
                $nameAndData[$dat[$i]->name] = array($dat[$i]->type, array());
            }
        }
        foreach ($data as $dat) {
            for ($i = 0; $i <= $numElements; $i++) {
                if (array_key_exists($dat[$i]->name, $nameAndData)) {
                    $nameAndData[$dat[$i]->name][1][0][] = $dat[$i]->userData;
                }
            }
        }

        // var_dump($nameAndData['text-1581968386744'][1][0]);
        // var_dump($nameAndData['select-1581968388862'][1][0]);
        $charts = new GenerateCharts();
        $charts = $charts->GenerateCharts($nameAndData);
        // var_dump($nameAndData);
        // var_dump($charts);
        // die;



        return view('response-data-view', ['responses' => $data, 'charts' => $charts]);
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