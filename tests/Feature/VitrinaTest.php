<?php

namespace Tests\Feature;

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VitrinaTest extends TestCase
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

        $this->cart =  new Cart();

        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testIndex()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('vitrina.index'));

        $response
            ->assertStatus(200)
            ->assertViewHas(['products', 'search'])
            ->assertViewIs('vitrina.index');
    }
}
