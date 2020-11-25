<?php

namespace Tests\Feature\Administrator\Payment\Cart;

use App\Entities\Cart;
use App\Entities\Category;
use App\Entities\Color;
use App\Entities\InCart;
use App\Entities\Product;
use App\Entities\Size;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudCartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(\PermissionsTableSeeder::class);

        $this->user = factory(User::class)->create([
            'active' => 1,
            'id' => 4
        ]);

        $this->user->assignRole('Administrator');

        $this->cart = new Cart();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testShow(): void
    {
        $this->withoutMiddleware();
        $response = $this->actingAs($this->user, 'web')
            ->get(route(
                'cart.show',
                'cart => Auth::user()->cart'
            ));
        $response
            ->assertStatus(200);
    }

    public function testHome(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route(
                'home',
                'cart => Auth::user()->cart'
            ));
        $response
            ->assertStatus(200);
    }

    public function testadd(): void
    {
        $this->withoutMiddleware();
        $this->product = factory(Product::class)->create();
        $this->color   = factory(Color::class)->create();
        $this->size    = factory(Size::class)->create();
        $this->category   = factory(Category::class)->create();

        $response = $this->actingAs($this->user)
            ->post(route('cart/add'),[
                'products_id' => $this->product->id,
                'stock' =>  '23',
                'color_id' => $this->color->id,
                'size_id' => $this->size->id,
                'category_id'=> $this->category->id
            ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('in_carts', [
            'stock' =>  '23',
            'color_id' => $this->color->id,
            'size_id' => $this->size->id,
        ]);
    }

    public function testRemove(): void
    {
        $this->withoutMiddleware();
        $this->product = factory(Product::class)->create();
        $this->color   = factory(Color::class)->create();
        $this->size    = factory(Size::class)->create();

        $this->user->cart->products = InCart::create([
            'stock'      => '12',
            'product_id' => $this->product->id,
            'color_id'   => $this->color->id,
            'size_id'    => $this->size->id,
            'cart_id'    => $this->user->cart->id,
        ]);

        $response = $this->actingAs($this->user, 'web')
            ->get(route('cart.remove', $this->user->cart->products->id), [
                    $this->user->cart->products->id
                ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseMissing('in_carts', [
        'size_id' => $this->size->id,
            ]);
    }

    public function testUpdate(): void
    {
        $this->withoutExceptionHandling();
        $this->product = factory(Product::class)->create();
        $this->color   = factory(Color::class)->create();
        $this->size    = factory(Size::class)->create();


        $this->user->cart->products = InCart::create([
            'id'         => 1,
            'stock'      => '12',
            'product_id' => $this->product->id,
            'color_id'   => $this->color->id,
            'size_id'    => $this->size->id,
            'cart_id'    => $this->user->cart->id,
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('cart.update', $this->user->cart->products->id), [
                'id'         => 1,
                'stock'      => '5',
                'product_id' => $this->product->id,
                'color_id'   => $this->color->id,
                'size_id'    => $this->size->id,
                'cart_id'    => $this->user->cart->id,
        ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('in_carts', [
            'stock'      => '5',
            'product_id' => $this->product->id,
            'color_id'   => $this->color->id,
            'size_id'    => $this->size->id,
            'cart_id'    => $this->user->cart->id,
        ]);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();
        $this->product = factory(Product::class)->create();
        $this->color   = factory(Color::class)->create();
        $this->size    = factory(Size::class)->create();

        $this->user->cart->products = InCart::create([
            'id'         => 6,
            'stock'      => '12',
            'product_id' => $this->product->id,
            'color_id'   => $this->color->id,
            'size_id'    => $this->size->id,
            'cart_id'    => $this->user->cart->id,
        ]);

        $response = $this->actingAs($this->user, 'web')
            ->delete(route('cart.destroy', $this->user->cart->products->id), [
                'id'         => 6,
                'stock'      => '5',
                'product_id' => $this->product->id,
                'color_id'   => $this->color->id,
                'size_id'    => $this->size->id,
                'cart_id'    => $this->user->cart->id,
            ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseMissing('in_carts', [
            'id'  => $this->user->cart->products->id,
        ]);
    }
}
