<?php

namespace Tests\Feature\Administrator\Products;

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ColorCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $this->seed(\PermissionsTableSeeder::class);
        $this->user = factory(User::class)->create();

        $this->user->assignRole('Administrator');

        $this->cart =  new Cart();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testIndex(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('colors.index'));
        $response
            ->assertStatus(200)
            ->assertViewHas('colors')
            ->assertViewIs('colors.index');
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('colors.store'), [
            'name' => 'amarillo',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('colors.index'));

        $this->assertDatabaseHas('colors', [
            'name' => 'amarillo'
        ]);
    }
}
