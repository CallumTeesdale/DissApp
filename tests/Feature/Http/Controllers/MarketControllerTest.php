<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
    $response->assertViewIs('market-view');
  }
  /**
   * @test
   */
  public function buy_item_returns_ok()
  {
    $user = factory(\App\User::class)->create();

    $response = $this->actingAs($user)->get(route('market.buy', 1));
    $response->assertOk();
    $response->assertViewIs('market-password-confirm');
    $response->assertViewHas('id');
  }
  /**
   * @test
   */
  public function buy_item_returns_ok_purchase()
  {
    $user = factory(\App\User::class)->create();

    $response = $this->actingAs($user)->get(route('market.purchase', 1));
    $response->assertOk();
    $response->assertViewIs('market-password-confirm');
    $response->assertViewHas('id');
  }
}