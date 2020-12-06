<?php

namespace Tests\Feature\Administrator\Products;

use App\Entities\User;
use App\Entities\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testViewCreatelogin()
    {
        $this->get(route('products.create'))
            ->assertRedirect(route('login'));
    }

    public function testViewIndexlogin()
    {
        $this->get(route('products.index'))
            ->assertRedirect(route('login'));
    }

    public function testDeleteProducts()
    {
        $products = factory(Product::class)->create();

        $this->delete(route('products.destroy', $products))
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('products', [
            'id' => $products->id,
        ]);
    }

    public function testDeleteAuth()
    {
        $product = factory(Product::class)->create();
        $this->delete(route('products.destroy', $product))
        ->assertStatus(302);
    }

    public function testActiveProduct()
    {
        $product = factory(Product::class)->create();
        $this->get(route('products.active', $product))
        ->assertStatus(302);
    }

    public function testEditAuth()
    {
        $product = factory(Product::class)->create();
        $this->get(route('products.edit', $product))
        ->assertStatus(302);
    }

    public function itCanSeeAllCategories()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $permission = Permission::create([
            'group' => 'categories' ,
            'name' => 'view categories' ,
            'label' => 'view categories'
        ]);

        $role = Role::find($user->role_id);

        $role->givePermissionTo($permission);

        $response = $this->get('/categories');

        $response->assertStatus(200);
    }
}
