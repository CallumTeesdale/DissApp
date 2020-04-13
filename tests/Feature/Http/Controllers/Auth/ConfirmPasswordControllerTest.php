<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Auth\ConfirmPasswordController
 */
class ConfirmPasswordControllerTest extends TestCase
{
    /**
     * @test
     */
    use RefreshDatabase;
    public function confirm_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create([
            'password' => 'password'
        ]);

        $response = $this->actingAs($user)->post('password/confirm', [
            $user->password
        ]);

        $response->assertRedirect();
    }

    /**
     * @test
     */
    public function show_confirm_form_returns_an_ok_response()
    {

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('password.confirm'));

        $response->assertOk();

    }

    // test cases...
}
