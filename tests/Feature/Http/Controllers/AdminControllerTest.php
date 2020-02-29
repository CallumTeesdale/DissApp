<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Market;

class AdminControllerTest extends TestCase
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
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);

        $response = $this->actingAs($user)->get(route('admin'));
        $response->assertOk();
        $response->assertViewIs('admin-view');
    }
    /**
     * @test
     */
    public function index_returns_ok_not_authorised()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);

        $response = $this->actingAs($user)->get(route('admin'));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }

    /**
     *@test
     */
    public function get_market_item_all_returns_ok()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);

        $response = $this->actingAs($user)->get(route('admin.get.market'));
        $response->assertOk();
        $response->assertViewIs('admin-view');
        $response->assertViewHas('variables');
    }

    /**
     *@test
     */
    public function get_market_item_all_returns_ok_not_authorised()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);

        $response = $this->actingAs($user)->get(route('admin.get.market'));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }
    /**
     *@test
     */
    public function edit_market_item_returns_ok()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $item = factory(\App\Market::class)->create();

        $response = $this->actingAs($user)->get(route('admin.market.edit.item', $item->id));
        $response->assertOk();
        $response->assertViewIs('market-item-form');
        $response->assertViewHas('item');
    }

    /**
     *@test
     */
    public function get_market_item_returns_ok_not_authorised()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $item = factory(\App\Market::class)->create();

        $response = $this->actingAs($user)->get(route('admin.market.edit.item', $item->id));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }
    /**
     *@test
     */
    public function create_market_item_returns_ok()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);

        $response = $this->actingAs($user)->get(route('admin.market.create.item'));
        $response->assertOk();
        $response->assertViewIs('market-item-form');
    }

    /**
     *@test
     */
    public function create_market_item_returns_ok_not_authorised()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);

        $response = $this->actingAs($user)->get(route('admin.market.create.item'));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }
    /**
     *@test
     */
    public function post_market_item_returns_ok()
    {
        $this->markTestIncomplete();
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $item = factory(\App\Market::class)->create();
        $response = $this->actingAs($user)->post(route('admin.market.post.item', [
            $item
        ]));
        $response->assertOk();
        $response->assertViewIs('');
    }
    /**
     *@test
     */

    public function post_market_item_returns_ok_not_authorised()
    {
        $this->markTestIncomplete();
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $item = factory(\App\Market::class)->create();

        $response = $this->actingAs($user)->post(route('admin.market.edit.item', $item->id));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }
}