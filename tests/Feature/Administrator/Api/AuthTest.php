<?php

namespace Tests\Feature\Administrator\Api;

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model|mixed
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(\PermissionsTableSeeder::class);

        $this->user = factory(User::class)->create([
            'email'    => 'admin@example.com',
            'password' => bcrypt('secret'),
            'active'   => 1
        ]);
        $this->user->assignRole('Administrator');
        $this->cart = new Cart();

        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testAuthApiAuthorize(): void
    {
        $user = factory(User::class)->create([
            'email'    => 'user@example.com',
            'password' => bcrypt('example'),
            'active'   => 1
        ]);

        $user->assignRole('Administrator');

        $this->postJson('/api/auth/login', [
            'email' => 'user@example.com',
            'password' => 'example',
        ]);

        $this->assertAuthenticated($guard = null);
    }

    public function testAuthApiNotAuthorize(): void
    {
        $credentials = [
            "email"    => "users@mail.com",
            "password" => "secret"
        ];

        $response = $this->from('api/auth/login')->postJson('api/auth/login', $credentials);

        $response
            ->assertStatus(401);

        $this->assertGuest($guard = null);

        $this->assertInvalidCredentials($credentials, $guard = null);
    }
}
