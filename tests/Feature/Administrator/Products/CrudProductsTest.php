<?php

namespace Tests\Feature\Administrator\Products;

use App\Entities\Cart;
use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Product;
use App\Entities\Size;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudProductsTest extends TestCase
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
            ->get(route('products.index'));

        $response
            ->assertStatus(200)
            ->assertViewHas(['products', 'search'])
            ->assertViewIs('products.index');
    }

    public function testDestroy()
    {
        $products = Product::create([
         'name'        => 'name',
         'description' => 'description',
         'price'       =>  100000,
         'stock'       => 5,
        ]);

        $response = $this->actingAs($this->user, 'web')
            ->delete(route('products.destroy', $products->id), [
            'id'  => $products->id
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', [
            'id'  => $products->id,
        ]);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();
        $this->seed([
            \ColorSeeder::class,
            \SizeSeeder::class
        ]);
        $product = Product::create([
            'name'        => 'name',
            'description' => 'description',
            'price'       => 5666,
            'stock'       => 5,
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('products.update', $product->id), [
                'name'  => 'nameup',
                'stock' => $product->stock,
                'color' => [Color::all()->random()->id],
                'size'  => [Size::all()->random()->id]
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'id'   => $product->id,
            'name' => 'nameup'
        ]);
    }

    public function testStore(): void
    {
        $this->withoutExceptionHandling();
        $this->seed([
            \ColorSeeder::class,
            \SizeSeeder::class,
            \CategorySeeder::class,
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('products.store'), [
            'name'  => 'new',
            'stock' => 56,
            'price' => 23456,
            'barcode' => '12324345354565',
            'description' => 'jdhfbgyebhsabfreahbfgy',
            'color' => [Color::all()->random()->id],
            'size' => [Size::all()->random()->id],
            'category' => [Category::all()->random()->id],
            'img' => '0af47a0f0bb89e7ce4d88f121faea42b.jpg'
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'name'  => 'new'
        ]);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('products.create'));

        $response
            ->assertViewIs('products.create')
            ->assertStatus(200);
    }

    public function testEditView()
    {
        $this->seed([
            \ColorSeeder::class,
            \SizeSeeder::class,
            \CategorySeeder::class,
        ]);

        $products = Product::create([
            'name'        => 'new',
            'stock'       => 56,
            'price'       => 23456,
            'barcode'     => '12324345354565',
            'description' => 'jdhfbgyebhsabfreahbfgy',
            'color'       => [Color::all()->random()->id],
            'size'        => [Size::all()->random()->id],
            'category'    => [Category::all()->random()->id],
            'img'         => '0af47a0f0bb89e7ce4d88f121faea42b.jpg'
        ]);

        $response = $this->actingAs($this->user, 'web')
            ->get(route('products.edit', $products->id));

        $response
            ->assertStatus(200)
            ->assertViewIs('products.edit');
    }

}
