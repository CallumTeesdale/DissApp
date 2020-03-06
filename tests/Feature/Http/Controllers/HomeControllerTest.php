<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HomeController
 */
class HomeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function about_returns_an_ok_response()
    {

        $response = $this->get(route('about'));

        $response->assertOk();
        $response->assertViewIs('public.about');
        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function contact_returns_an_ok_response()
    {
        $response = $this->get(route('contact'));

        $response->assertOk();
        $response->assertViewIs('public.contact');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertViewIs('public.home');

        // TODO: perform additional assertions
    }

    // test cases...
}
