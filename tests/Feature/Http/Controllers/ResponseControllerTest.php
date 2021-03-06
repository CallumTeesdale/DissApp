<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ResponseController
 */
class ResponseControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('response.create'));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete('');

        $response = factory(\App\Response::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->delete(
            route('response.destroy', [$response])
        );

        $response->assertOk();
        $this->assertDeleted($response);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $response = factory(\App\Response::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(
            route('response.edit', [$response])
        );

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('response.index'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $user1 = factory(\App\User::class)->create();
        $survey = factory(\App\Survey::class)->create([
            'id' => 1,
            'user_id' => 1
        ]);
        $user2 = factory(\App\User::class)->create([
            'id' => 5,
        ]);
        $responses = factory(\App\Response::class)->create();

        $response = $this->actingAs($user2)->get(
            route('response.show', $survey->id)
        );

        $response->assertOk();
        $response->assertViewIs('response.render-survey');
        $response->assertViewHas('survey');
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->postJson(route('response.store'), [
            'userData' => [
                [
                    'type' => 'header',
                    'label' => 'Header'
                ],
                [
                    'name' => 'text-1582305226597',
                    'type' => 'text',
                    'label' => 'Text Field',
                    'className' => 'form-control',
                    'userData' => ['test 4']
                ]
            ],
            'survey_id' => 12
        ]);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function success_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get(route('successResponse'));

        $response->assertOk();
        $response->assertViewIs('response.survey-response-success');
    }
    /**
     * @test
     */
    public function fail_returns_ok_response_response()
    {
        $response = $this->get(route('failResponse'));

        $response->assertOk();
        $response->assertViewIs('response.survey-response-fail');
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $response = factory(\App\Response::class)->create();
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->put(
            route('response.update', [$response]),
            [
                // TODO: send request data
            ]
        );

        $response->assertOk();
    }
}
