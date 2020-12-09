<?php

namespace Tests\Feature\Administrator\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister(): void
    {
        $credentials = [
            'name'                  => 'new',
            'phone'                 => '123445',
            'cellphone'             => '12445',
            'document'              => '445566',
            'address'               => 'car33767',
            'email'                 => 'marianew@hotmail.com',
            'password'              => '123456987',
            'password_confirmation' => '123456987'
        ];

        $response = $this->from('/register')->post('/register', $credentials);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        $this->assertCredentials($credentials, $guard = null);

        $this->assertDatabaseHas('users', [
            'name'      => 'new',
            'phone'     => '123445',
            'cellphone' => '12445',
            'document'  => '445566',
            'address'   => 'car33767',
            'email'     => 'marianew@hotmail.com',
        ]);
    }

    public function testRegisterErrors(): void
    {
        $credentials = [];

        $response = $this->from('/register')->post('/register', $credentials);

        $this->assertInvalidCredentials($credentials, $guard = null);

        $response->assertSessionHasErrors([
            'name',
            'phone',
            'cellphone',
            'document',
            'address',
            'email',
        ]);
    }
}
