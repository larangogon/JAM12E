<?php

namespace Tests\Feature\Administrator\Usuarios;

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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
        $response = $this->actingAs($this->user, 'web')->get(route('users.index'));
        $response
            ->assertStatus(200)
            ->assertViewHas(['users', 'search'])
            ->assertViewIs('users.index');

        $this->assertAuthenticatedAs($this->user, $guard = null);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('users.create'));

        $response
            ->assertViewIs('users.create')
            ->assertStatus(200);

        $this->assertAuthenticatedAs($this->user, $guard = null);
    }

    public function testEditView()
    {
        $users = User::create([
            'name'              => 'carmen',
            'phone'             => '123445',
            'cellphone'         => '12445',
            'document'          => '445566',
            'address'           => 'car33767',
            'email'             => 'carmen@hotmail.com',
            'active'            => 1,
            'email_verified_at' => now(),
            'password'          => '123456',
        ]);

        $response = $this->actingAs($this->user, 'web')
            ->get(route('users.edit', $users->id));

        $response
            ->assertStatus(200)
            ->assertViewIs('users.edit');

        $this->assertAuthenticatedAs($this->user, $guard = null);
    }

    public function testUpdate()
    {
        $user = User::create([
            'name'              => 'carmen',
            'phone'             => '123445',
            'cellphone'         => '12445',
            'document'          => '445566',
            'address'           => 'car33767',
            'email'             => 'carmen@hotmail.com',
            'active'            => 1,
            'email_verified_at' => now(),
            'password'          => '123456',
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('users.update', $user->id), [
                'name'      => 'carmelo',
                'phone'     => '123445',
                'cellphone' => '12445',
                'document'  => '445566',
                'address'   => 'car33767',
                'email'     => 'carmen@hotmail.com',
                'active'    => 1,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id'   => $user->id,
            'name' => 'carmelo'
        ]);
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('users.store'), [
                'name'      => 'new',
                'phone'     => '123445',
                'cellphone' => '12445',
                'document'  => '445566',
                'address'   => 'car33767',
                'email'     => 'carmen@hotmail.com',
                'active'    => 1,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name'  => 'new'
        ]);

        $this->assertAuthenticatedAs($this->user, $guard = null);
    }

    public function testStoreErrors(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('users.store'), []);

        $response->assertSessionHasErrors([
            'name',
            'phone',
            'cellphone',
            'document',
            'address',
            'email',
            ]);
    }

    public function testUpdateErrors(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->user)
            ->put(route('users.update', $user->id), []);

        $response->assertSessionHasErrors([
            'name',
            'phone',
            'cellphone',
            'document',
            'address',
        ]);
    }

    public function testUpdateActive()
    {
        $user = User::create([
            'name'              => 'carmen',
            'phone'             => '123445',
            'cellphone'         => '12445',
            'document'          => '445566',
            'address'           => 'car33767',
            'email'             => 'carmen@hotmail.com',
            'active'            => 1,
            'email_verified_at' => now(),
            'password'          => '123456',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('users.active', $user->id), [
                'active' => 0
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id'     => $user->id,
            'name'   => 'carmen',
            'active' => 0
        ]);
    }
}
