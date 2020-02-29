<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarketControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /**
     * @test
     */
    public function index_returns_ok()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('market'));
        $response->assertOk();
        $response->assertViewIs('market-view');
    }
}