<?php

namespace Tests\Feature;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itShouldShowLoginPage()
    {
        // action
        $response = $this->get(route('login'));

        // test
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function itShouldLoggedInWhenUsingValidCredentialsUsingUsername()
    {
        // setup
        $userData = factory(Admin::class)->make()->toArray();
        $userData['password'] = $this->faker->password();
        $userPassword = $userData['password'];
        $userData['password'] = Hash::make($userData['password']);
        $user = Admin::create($userData);

        // action
        $response = $this->post('/login', ['identity' => $userData['username'], 'password' => $userPassword]);

        // test
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect(route('beranda'));
    }

    /** @test */
    public function itShouldLoggedInWhenUsingValidCredentialsUsingEmail()
    {
        // setup
        $userData = factory(Admin::class)->make()->toArray();
        $userData['password'] = $this->faker->password();
        $userPassword = $userData['password'];
        $userData['password'] = Hash::make($userData['password']);
        $user = Admin::create($userData);

        // action
        $response = $this->post('/login', ['identity' => $userData['email'], 'password' => $userPassword]);

        // test
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect(route('beranda'));
    }

    /** @test */
    public function itShouldLoggedInWhenUsingValidCredentialsUsingNip()
    {
        // setup
        $userData = factory(Admin::class)->make()->toArray();
        $userData['password'] = $this->faker->password();
        $userPassword = $userData['password'];
        $userData['password'] = Hash::make($userData['password']);
        $user = Admin::create($userData);

        // action
        $response = $this->post('/login', ['identity' => $userData['nip'], 'password' => $userPassword]);

        // test
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect(route('beranda'));
    }

    /** @test */
    public function itShouldRedirectedBackToLoginPageWithErrorWhenUsingInvalidUsername()
    {
        // setup
        factory(Admin::class)->create();

        // action
        $response = $this->post('/login', ['identity' => 'invalid', 'password' => 'invalid']);

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function itShouldRedirectedBackToLoginPageWithErrorWhenUsingInvalidNip()
    {
        // setup
        factory(Admin::class)->create();

        // action
        $response = $this->post('/login', ['identity' => '1970010120000110001', 'password' => 'invalid']);

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('nip');
    }

    /** @test */
    public function itShouldRedirectedBackToLoginPageWithErrorWhenUsingInvalidEmail()
    {
        // setup
        factory(Admin::class)->create();

        // action
        $response = $this->post('/login', ['identity' => 'invalid@example.com', 'password' => 'invalid']);

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function itShouldRedirectedBackToLoginPageWithErrorWhenUsingInvalidPassword()
    {
        // setup
        $user = factory(Admin::class)->create();

        // action
        $response = $this->post('/login', ['identity' => $user->username, 'password' => 'invalid']);

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('password');
        $response->assertSessionHasInput('identity');
    }
}
