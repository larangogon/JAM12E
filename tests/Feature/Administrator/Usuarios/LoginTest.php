<?php

namespace Tests\Feature\Administrator\Usuarios;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    public function testItVisitPageOfLogin()
    {
        $this->get('/login')
            ->assertStatus(200);
    }
    public function testNotAuthenticateToAUserWithCredentialsInvalid()
    {
        $credentials = [
            "email" => "users@mail.com",
            "password" => "secret"
        ];

        $this->assertInvalidCredentials($credentials);
    }

    public function testTheEmailIsRequiredForAuthenticate()
    {
        $credentials = [
            "email" => null,
            "password" => "secret"
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response
            ->assertRedirect('/login');
    }

    public function testThePasswordIsRequiredForAuthenticate()
    {
        $credentials = [
            "email" => "zaratedev@gmail.com",
            "password" => null
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response
            ->assertRedirect('/login');
    }
}
