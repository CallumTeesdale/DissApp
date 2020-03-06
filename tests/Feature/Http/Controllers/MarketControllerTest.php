<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Market;
use App\Barcode;

class MarketControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_returns_ok()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('market'));
        $response->assertOk();
        $response->assertViewIs('market.market-view');
    }
    /**
     * @test
     */
    public function buy_item_returns_ok()
    {
        $user = factory(\App\User::class)->create();
        $item = factory(\App\Market::class)->create([
            'id' => 1
        ]);


        $response = $this->actingAs($user)->get(route('market.buy', 1));
        $response->assertOk();
        $response->assertViewIs('market.market-password-confirm');
        $response->assertViewHas('id');
    }
    /**
     * @test
     */
    public function buy_item_returns_ok_purchase()
    {
        $user = factory(\App\User::class)->create();
        $barcodes = factory(\App\Barcode::class)->create();
        $item = factory(\App\Market::class)->create([
            'id' => 1,
        ]);

        $response = $this->actingAs($user)->post(route('market.purchase', [
            'id' => 1,
            'password' => $user->password,
        ]));

        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('title', 'Enjoy!');
    }
    /**
     * @test
     */
    public function buy_item_returns_error_purchase()
    {
        $this->withoutExceptionHandling();
        $user = factory(\App\User::class)->create();
        $item = factory(\App\Market::class)->create([
            'id' => 1,
        ]);

        $response = $this->actingAs($user)->post(route('market.purchase', [
            'id' => 1,
            'password' => 'wrong',
        ]));

        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('title', 'Something went wrong');
    }
}
