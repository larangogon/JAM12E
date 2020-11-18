<?php

namespace Tests\Feature\Administrator\Report;

use App\Entities\Cart;
use App\Entities\Spending;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpetingTest extends TestCase
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
            ->get(route('spendings.index'));

        $response
            ->assertStatus(200)
            ->assertViewHas(['spendings', 'search'])
            ->assertViewIs('spendings.index');
    }

    public function testDestroy()
    {
        $spenting = Spending::create([
            'description' => 'description',
            'total'       =>  100000,
        ]);

        $response = $this->actingAs($this->user, 'web')
            ->delete(route('spendings.destroy', $spenting->id), [
                'id'  => $spenting->id
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('spendings.index'));

        $this->assertDatabaseMissing('spendings', [
            'id'  => $spenting->id,
        ]);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();
        $spenting = Spending::create([
            'description' => 'description',
            'total'       => 5666,
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('spendings.update', $spenting->id), [
                'description'  => 'description uptated',
                'total'        => 364553
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('spendings.index'));

        $this->assertDatabaseHas('spendings', [
            'id'  => $spenting->id,
            'description'  => 'description uptated',
        ]);
    }

    public function testStore(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
            ->post(route('spendings.store'), [
                'description' => 'new description',
                'total'       => 100000
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('spendings.index'));

        $this->assertDatabaseHas('spendings', [
            'description' => 'new description',
            'total'       => 100000,
        ]);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('spendings.create'));

        $response
            ->assertViewIs('spendings.create');
    }

    public function testEditView()
    {
        $spendings = Spending::create([
            'description' => 'new description',
            'total'       => 100000
        ]);
        $response = $this->actingAs($this->user, 'web')
            ->get(route('spendings.edit', $spendings->id));

        $response
            ->assertStatus(200)
            ->assertViewIs('spendings.edit');
    }
}
