<?php

namespace Tests\Feature\Http\Controllers\Auth;


use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function successfulRegistrationRoute()
    {
        return route('profile');
    }

    protected function registerGetRoute()
    {
        return route('register');
    }

    protected function registerPostRoute()
    {
        return route('register');
    }

    protected function guestMiddlewareRoute()
    {
        return route('profile');
    }

    public function testUserCanViewARegistrationForm()
    {
        $response = $this->get($this->registerGetRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function testUserCannotViewARegistrationFormWhenAuthenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get($this->registerGetRoute());

        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    public function testUserCanRegister()
    {
        Event::fake();

        $response = $this->post($this->registerPostRoute(), [
            'username' => '123',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => '123@123.com',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $response->assertRedirect($this->successfulRegistrationRoute());
        $this->assertCount(1, $user = User::all());
        $this->assertAuthenticatedAs($user = $user->first());
        $this->assertEquals('123', $user->username);
        $this->assertEquals('123@123.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
        Event::assertDispatched(Registered::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }

    public function testUserCannotRegisterWithoutName()
    {

        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'username' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => '123@123.com',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('username');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutEmail()
    {

        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'username' => '123',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => '',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithInvalidEmail()
    {

        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'username' => '123',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => '123',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPassword()
    {
        $user = factory(User::class)->create();
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'username' => '123',
            'password' => '',
            'password_confirmation' => 'password',
            'email' => '123',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPasswordConfirmation()
    {

        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'username' => '123',
            'password' => 'password',
            'password_confirmation' => '',
            'email' => '123',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithPasswordsNotMatching()
    {

        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'username' => '123',
            'password' => 'password',
            'password_confirmation' => 'test',
            'email' => '123',
            'priv_level' => 1,
            'dob' => '2020-09-09',
            'course' => 'course',
            'about' => 'about'
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}