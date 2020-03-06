<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SurveyController
 */
class SurveyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('surveys.create'));

        $response->assertOk();
        $response->assertViewIs('surveys.edit-survey');
    }



    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete();
        $survey = factory(\App\Survey::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->delete(route('surveys.destroy', [$survey]));

        $response->assertOk();
        $this->assertDeleted($survey);
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {

        $survey = factory(\App\Survey::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('surveys.edit', [$survey]));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {

        $user = factory(\App\User::class)->create(
            [
                'id' => 1,
            ]
        );
        $surv = factory(\App\Survey::class)->create(
            [
                'id' => 1,
            ]
        );
        $responses = factory(\App\Response::class)->create([
            'user_id' => 1,
        ]);


        $response = $this->actingAs($user)->get(route('surveys.index'));

        $response->assertOk();
        $response->assertViewIs('surveys.survey-listing');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();
        $survey = factory(\App\Survey::class)->create();
        $response = factory(\App\Response::class)->create([
            'survey_id' => $survey->id
        ]);


        $response = $this->actingAs($user)->get(route('surveys.show', $survey->id));

        $response->assertOk();
        $response->assertViewIs('surveys.response-data-view');
        $response->assertViewHas('charts');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->postJson(route('surveys.store'), [
            // TODO: send request data
            'json' =>
            [
                [
                    'type' => 'textarea',
                    'label' => 'Text Area',
                    'className' => 'form-control',
                    'name' => 'textarea-1582314765616'
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Text Area',
                    'className' => 'form-control',
                    'name' => 'textarea-1582314766165'
                ],
            ],
            'title' => 'title',
            'description' => 'desription',
            'category' => 1,
        ]);
        $response->assertOk();
    }


    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $survey = factory(\App\Survey::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->put(route('surveys.update', $survey), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    // test cases...
}
