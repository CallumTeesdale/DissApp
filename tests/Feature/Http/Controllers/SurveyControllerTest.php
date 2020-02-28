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

        //$response->assertOk();
        $response->assertViewIs('edit-survey');

        // TODO: perform additional assertions
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

        // TODO: perform additional assertions
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

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('surveys.index'));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();
        $response = factory(\App\Response::class)->create();
        $survey = factory(\App\Survey::class)->create();


        $response = $this->actingAs($user)->get(route('surveys.show', $survey->id));

        $response->assertOk();
        $response->assertViewIs('response-data-view');
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
        ]);
        $response->assertOk();

        // TODO: perform additional assertions
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