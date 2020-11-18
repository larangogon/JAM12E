<?php

namespace Tests\Feature\Administrator\Payment\Order;

use App\Entities\Cart;
use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Detail;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Size;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderCreateTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(\PermissionsTableSeeder::class);

        $this->user = factory(User::class)->create();
        $this->user->assignRole('Administrator');

        $this->cart = new Cart();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    /**
     * @return void
     */
    public function testOrderStorePay(): void
    {
        $this->product = factory(Product::class)->create(['id' => '1']);
        $this->size = factory(Size::class)->create(['id' => '1']);
        $this->color = factory(Color::class)->create(['id' => '1']);
        $this->category = factory(Category::class)->create(['id' => '1']);
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user, 'web')
            ->post(route('orders.paymentInStore'), [

                $order = Order::create([
                    'user_id' => $this->cart->user_id,
                    'total'   => '6000',
                    'status'  => 'APROVADO_T',
                ]),

            $detail = Detail::create([
                'order_id'    => $order->id,
                'product_id'  => $this->product->id,
                'size_id'     => $this->size->id,
                'category_id' => $this->category->id,
                'color_id'    => $this->color->id,
                'stock'       => '3',
                'total'       => '30000',
            ]),

        Payment::create([
            'order_id'   => $order->id,
            'status'     => 'APROVADO_T',
            'base'       => 'tienda',
            'message'    => 'pago generado en la tienda por el admin',
            'document'   => '23344555',
            'name'       => 'mari',
            'email'      => 'joha@example.com',
            'mobile'     => '87655594',
            'amount'     => $order->total,
            'totalStore' => '60000',
            ]),

        ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->cart->user_id,
        ]);

        $this->assertDatabaseHas('payments', [
            'order_id'   => $order->id,
        ]);

        $this->assertDatabaseHas('details', [
            'order_id'    => $order->id,
            'product_id'  => $this->product->id,
            'size_id'     => $this->size->id,
            'category_id' => $this->category->id,
            'color_id'    => $this->color->id,
            'stock'       => '3',
            'total'       => '30000',
        ]);

    }

    /**
     * @return void
     */
    public function testOrdercreate(): void
    {
        $this->product = factory(Product::class)->create(['id' => '1']);
        $this->size = factory(Size::class)->create(['id' => '1']);
        $this->color = factory(Color::class)->create(['id' => '1']);
        $this->category = factory(Category::class)->create(['id' => '1']);
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user, 'web')
            ->post(route('orders.store'), [

                $order = Order::create([
                    'user_id' => $this->cart->user_id,
                    'total' => '6000',
                    'status' => 'APROVADO_T',
                ]),

                $detail = Detail::create([
                    'order_id' => $order->id,
                    'product_id' => $this->product->id,
                    'size_id' => $this->size->id,
                    'category_id' => $this->category->id,
                    'color_id' => $this->color->id,
                    'stock' => '3',
                    'total' => '30000',
                ]),

                Payment::create([
                    'order_id' => $order->id,
                ]),

            ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->cart->user_id,
            'total' => '6000',
            'status' => 'APROVADO_T',
        ]);

        $this->assertDatabaseHas('payments', [
            'order_id' => $order->id,
        ]);

        $this->assertDatabaseHas('details', [
            'order_id' => $order->id,
        ]);
    }
}
