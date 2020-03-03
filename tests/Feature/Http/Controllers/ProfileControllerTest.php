<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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
        $response->assertViewIs('profile.profile');
        $response->assertViewHas('surveys');
        $response->assertViewHas('balance');
    }
    /**
     * @test
     */
    public function get_profile_edit_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get(route('edit.profile'));
        $response->assertOk();
        $response->assertViewIs('profile.edit-profile-form');
    }
    /**
     * @test
     */
    public function post_profile_edit_returns_ok_response()
    {
        Storage::fake('public');
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->post(route('edit.profile'), [
            'email' => $user->email,
            'course' => $user->course,
            'about' => $user->about,
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);
        $response->assertRedirect('/profile');
        Storage::disk('public')->assertExists('/avatars/' . $user->avatar);
    }
    /**
     * @test
     */
    public function post_profile_edit_returns_ok_response_no_file()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->post(route('edit.profile'), [
            'email' => $user->email,
            'course' => $user->course,
            'about' => $user->about
        ]);
        $response->assertRedirect('/profile');
    }
    /**
     * @test
     */
    public function post_profile_edit_returns_error()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->post(route('edit.profile'), [
            'email' => 'not an email',
            'course' => $user->course,
            'about' => $user->about,
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);
        $response->assertOk();
        $response->assertViewIs('generic-message-view');
        $response->assertViewHas('message');
    }

    /**
     * @test
     */
    public function delete_success()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->post(route('profile.delete', $user->id));
        $response->assertRedirect('/');
    }
    /**
     * @test
     */
    public function delete_fail()
    {
        $user = factory(\App\User::class)->create();
        $user2 = factory(\App\User::class)->create([
            'id' => 2,
        ]);
        $response = $this->actingAs($user)->post(route('profile.delete', $user2->id));
        $response->assertRedirect('/profile');
    }
}