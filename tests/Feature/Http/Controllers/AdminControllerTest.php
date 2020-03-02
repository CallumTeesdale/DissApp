<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Market;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
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

        $response = $this->actingAs($user)->get(route('admin.market.edit.item', 1));
        $response->assertOk();
        $response->assertViewIs('market-item-form');
        $response->assertViewHas('item');
    }

    /**
     *@test
     */
    public function edit_market_item_returns_ok_not_authorised()
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
        $this->withoutExceptionHandling();
        Storage::fake('public');
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $item = factory(\App\Market::class)->create();
        $response = $this->actingAs($user)->post(route('admin.market.post.item'), [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'live' => $item->live,
            'barcode' => $item->barcode,
            'image' => UploadedFile::fake()->image('item.jpg'),

        ]);
        $response->assertOk();
        $response->assertViewIs('admin-view');
        Storage::disk('public')->assertExists('/market/' . $item->id . '.jpg');
    }
    /**
     *@test
     */

    public function post_market_item_returns_ok_not_authorised()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $item = factory(\App\Market::class)->create();

        $response = $this->actingAs($user)->post(route('admin.market.post.item'), [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'live' => $item->live,
            'barcode' => $item->barcode,
            'image' => UploadedFile::fake()->image('image.jpg'),

        ]);;
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }
    /**
     *@test
     */
    public function post_market_item_returns_ok_create_no_id()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $item = factory(\App\Market::class)->create();

        $response = $this->actingAs($user)->post(route('admin.market.post.item'), [
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'live' => $item->live,
            'barcode' => $item->barcode,

        ]);
        $response->assertOk();
        $response->assertViewIs('admin-view');
        Storage::disk('public')->assertExists('/market/item.jpg');
    }
}