<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProfileController
 */
class ProfileControllerTest extends TestCase
{
    /**
     * @test
     */
    use RefreshDatabase;
    public function get_profile_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('profile'));

        $response->assertOk();
        $response->assertViewIs('profile');
        $response->assertViewHas('surveys');
        $response->assertViewHas('balance');

        // TODO: perform additional assertions
    }
    public function get_profile_edit_returns_an_ok_response()
    {
        $response = $this->actingAs($user)->get(route(''));
        $response->assertOk();
        $response->assertViewIs('edit-profile-form');
    }
}