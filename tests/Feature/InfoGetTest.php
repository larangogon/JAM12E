<?php

namespace Tests\Feature;

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfoGetTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\PermissionsTableSeeder::class);

        $this->user = factory(User::class)->create([
            'active' => 1,
        ]);
        $this->user->assignRole('Administrator');

        $this->cart = new Cart();

        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testIndex()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('about-us.index'));

        $response
            ->assertStatus(200)
            ->assertViewIs('about.index');
    }
}
