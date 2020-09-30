<?php

namespace Tests\Feature\Administrator\Usuarios;

use App\User;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    public function testUsuariosTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('users');

        $response->assertStatus(200);
    }

    public function testlogin_displays_the_login_form(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function testlogin_authenticates_and_redirects_user(): void
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
        'email'    => $user->email,
        'password' => 'password',
    ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function testlogin_displays_validation_errors(): void
    {
        $response = $this->post(route('login'), []);

        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }
}
