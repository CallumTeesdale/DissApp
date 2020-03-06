<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Market;
use App\Barcode;
use App\Category;
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
     * Get uploadable file.
     *
     * @return UploadedFile
     */
    protected function getUploadableFile($file)
    {
        $dummy = file_get_contents($file);

        file_put_contents(base_path("tests/" . basename($file)), $dummy);

        $path = base_path("tests/" . basename($file));
        $original_name = 'subscribers.csv';
        $mime_type = 'text/csv';
        $size = 111;
        $error = null;
        $test = true;

        $file = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

        return $file;
    }

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
        $response->assertViewIs('admin.admin-view');
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
        //$response->assertOk();
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
        $response->assertViewIs('admin.admin-view');
        $response->assertViewHas('items');
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
        $response->assertViewIs('admin.market-item-form');
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
        $response->assertViewIs('admin.market-item-form');
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
        Storage::fake('public');
        $barcodes = $this->getUploadableFile(base_path("tests/barcodes.csv"));
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
            'barcodes' => $barcodes,
            'image' => UploadedFile::fake()->image('item.jpg'),

        ]);
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
        Storage::disk('public')->assertExists('/market/' . $item->id . '.jpg');
    }
    /**
     *@test
     */
    public function post_market_item_returns_ok_no_id()
    {
        Storage::fake('public');
        $barcodes = $this->getUploadableFile(base_path("tests/barcodes.csv"));
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $item = factory(\App\Market::class)->create();
        $response = $this->actingAs($user)->post(route('admin.market.post.item'), [
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'live' => $item->live,
            'barcodes' => $barcodes,
            'image' => UploadedFile::fake()->image('item.jpg'),

        ]);
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
        Storage::disk('public')->assertExists('/market/' . '2.jpg');
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

        ]);
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
        $response->assertViewIs('admin.admin-view');
        Storage::disk('public')->assertExists('/market/item.jpg');
    }

    /**
     * @test
     */
    public function delete_market_item_sucess()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $item = factory(\App\Market::class)->create();
        $barcodes = factory(\App\Barcode::class)->create(['market_id' => $item->id]);

        $response = $this->actingAs($user)->post(route('admin.market.item.delete', $item->id));
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
    }
    /**
     * @test
     */
    public function delete_market_item_fail()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $item = factory(\App\Market::class)->create();
        $barcodes = factory(\App\Barcode::class)->create(['market_id' => $item->id]);

        $response = $this->actingAs($user)->post(route('admin.market.item.delete', $item->id));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
    }

    /**
     *@test
     */
    public function get_categories_all_returns_ok()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);

        $response = $this->actingAs($user)->get(route('admin.get.categories'));
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
        $response->assertViewHas('categories');
    }
    /**
     *@test
     */
    public function get_categories_all_returns_fail()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);

        $response = $this->actingAs($user)->get(route('admin.get.categories'));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
    }
    /**
     *@test
     */
    public function get_categories_edit_returns_ok()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $category = \factory(\App\Category::class)->create();

        $response = $this->actingAs($user)->get(route('admin.edit.category', $category->id));
        $response->assertOk();
        $response->assertViewIs('admin.category-form');
    }
    /**
     *@test
     */
    public function get_categories_edit_returns_ok_not_auth()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $category = \factory(\App\Category::class)->create();

        $response = $this->actingAs($user)->get(route('admin.edit.category', $category->id));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
    }
    /**
     *@test
     */
    public function post_categories_edit_returns_ok_id()
    {
        Storage::fake('public');
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $category = \factory(\App\Category::class)->create();


        $response = $this->actingAs($user)->post(route('admin.category.post'), [
            'id' => $category->id,
            'name' => $category->name,
            'image' => UploadedFile::fake()->image('image.jpg'),

        ]);
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
        Storage::disk('public')->assertExists('/categories/' . '1.jpg');
    }
    /**
     *@test
     */
    public function post_categories_edit_returns_ok_no_id()
    {
        Storage::fake('public');
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $category = \factory(\App\Category::class)->create();


        $response = $this->actingAs($user)->post(route('admin.category.post'), [
            'name' => $category->name,
            'image' => UploadedFile::fake()->image('image.jpg'),

        ]);
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
        Storage::disk('public')->assertExists('/categories/' . '2.jpg');
    }
    /**
     *@test
     */
    public function post_categories_edit_returns_ok_not_auth()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $category = \factory(\App\Category::class)->create();

        $response = $this->actingAs($user)->get(route('admin.edit.category', $category->id));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
    }
    /**
     * @test
     */
    public function delete_category_success()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 1,
        ]);
        $cat = factory(\App\Category::class)->create(['id' => 1,]);
        $response = $this->actingAs($user)->post(route('admin.category.delete', $cat->id));
        $response->assertOk();
        $response->assertViewIs('admin.admin-view');
    }
    /**
     * @test
     */
    public function delete_category_fail()
    {
        $user = factory(\App\User::class)->create([
            'priv_level' => 0,
        ]);
        $cat = factory(\App\Category::class)->create();
        $response = $this->actingAs($user)->post(route('admin.market.item.delete', $cat->id));
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
    }
}
