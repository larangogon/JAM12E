<?php

namespace Tests\Feature\Administrator\Api;

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SizeApiTest extends TestCase
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
            'active' => 1
        ]);
        $this->user->assignRole('Administrator');
        $this->cart = new Cart();

        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }


    public function testStore(): void
    {
        $response = $this->actingAs($this->user, 'api')
            ->postJson(route('size.store'), [
                'name' => 'xs',
            ]);

        $response
            ->assertStatus(200);

        $this->assertDatabaseHas('sizes', [
            'name' => 'xs'
        ]);
    }

    public function testIndex(): void
    {
        $response = $this->actingAs($this->user, 'api')
            ->getJson(route('size.index'));

        $response
            ->assertStatus(200);
    }
}
