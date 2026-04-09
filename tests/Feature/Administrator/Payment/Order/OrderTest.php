<?php

namespace Tests\Feature\Administrator\Payment\Order;

use App\Constants\Statuses;
use App\Entities\Cart;
use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Detail;
use App\Entities\InCart;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Size;
use App\Entities\User;
use Database\Seeders\PermissionsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        $this->seed(PermissionsTableSeeder::class);

        $this->user = factory(User::class)->create();
        $this->user->assignRole('Administrator');

        $this->cart = new Cart();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testIndex(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('orders.index'));

        $response
            ->assertStatus(200)
            ->assertViewHas(['orders', 'search'])
            ->assertViewIs('orders.index');

        $this->assertAuthenticatedAs($this->user);
    }

    public function testShowv(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('orders.showv', $this->user->id));

        $response
            ->assertStatus(200)
            ->assertViewHas(['orders'])
            ->assertViewIs('orders.showv');

        $this->assertAuthenticatedAs($this->user);
    }

    public function testStore(): void
    {
        Http::fake([
            'http://test.placetopay.com/*' => Http::response([
                'status' => [
                    'status' => 'OK',
                    'reason' => 'Created',
                    'date' => now()->toIso8601String(),
                ],
                'requestId' => 429524,
                'processUrl' => 'https://test.placetopay.com/redirection/session/429524/47a34d65abeee316e36f882d3757a355',
                'payment' => [
                    [
                        'status' => 'OK',
                        'internalReference' => '12345',
                        'reference' => '1',
                        'amount' => [
                            'from' => [
                                'total' => 100,
                            ],
                        ],
                    ],
                ],
            ], 201),
        ]);

        $color = factory(Color::class)->create();
        $size = factory(Size::class)->create();
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create();

        InCart::create([
            'stock' => 23,
            'color_id' => $color->id,
            'size_id' => $size->id,
            'category_id' => $category->id,
            'product_id' => $product->id,
            'cart_id' => $this->cart->id,
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('orders.store'), [
                'cart_id' => $this->cart->id,
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('orders', [
            'user_id' => $this->cart->user_id,
        ]);

        $this->assertAuthenticatedAs($this->user);
    }

    public function testStoreTotalNull(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('orders.store'), [
                'cart_id' =>  $this->cart->id,
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Continue with your purchase')
            ->assertRedirect('storefront');

        $this->assertAuthenticatedAs($this->user);
    }

    public function testUpdate()
    {
        Http::fake([
            'http://test.placetopay.com/*' => Http::response([
                'status' => [
                    'status' => 'APPROVED',
                    'reason' => 'Approved',
                    'date' => now()->toIso8601String(),
                    'message' => 'Transaction approved',
                ],
                'payment' => [
                    [
                        'status' => 'APPROVED',
                        'internalReference' => '12345',
                        'reference' => '1',
                        'amount' => [
                            'from' => [
                                'total' => 100,
                            ],
                        ],
                    ],
                ],
                'request' => [
                    'payer' => [
                        'document' => '123456789',
                        'name' => 'John Doe',
                        'email' => 'john@example.com',
                        'mobile' => '3123456789',
                    ],
                    'locale' => 'es_CO',
                ],
            ], 200),
        ]);

        $color = factory(Color::class)->create();
        $size = factory(Size::class)->create();
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create();

        InCart::create([
            'stock' => 23,
            'color_id' => $color->id,
            'size_id' => $size->id,
            'category_id' => $category->id,
            'product_id' => $product->id,
            'cart_id' => $this->cart->id,
        ]);

        $order = Order::create([
            'user_id' => $this->cart->user_id,
            'total' => $this->cart->valueCart(),
        ]);

        foreach ($this->cart->products as $product) {
            Detail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'size_id' => $product->pivot->size_id,
                'category_id' => $product->pivot->category_id,
                'color_id' => $product->pivot->color_id,
                'stock' => $product->pivot->stock,
                'total' => $product->price * $product->pivot->stock,
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'processUrl' => 'https://test.placetopay.com/redirection/session/429524/47a34d65abeee316e36f882d3757a355',
            'requestId' => '429524',
            'status' => Statuses::PENDING,
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('orders.update', $order->id), [
                'status' => Statuses::APPROVED,
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('payments', [
            'order_id' => $order->id,
            'status' => 'APPROVED',
        ]);

        $this->assertAuthenticatedAs($this->user);
    }

    public function testPayInStore()
    {
        $color = factory(Color::class)->create();
        $size = factory(Size::class)->create();
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create();

        InCart::create([
            'stock' => 23,
            'color_id' => $color->id,
            'size_id' => $size->id,
            'category_id' => $category->id,
            'product_id' => $product->id,
            'cart_id' => $this->cart->id,
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('orders.paymentInStore'), [
                'cart_id' => $this->cart->id,
                'name' => 'Ana',
                'document' => '123456789',
                'email' => 'admin@example.com',
                'mobile' => '23456789',
                'totalStore' => '2345678',
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Order created successfully')
            ->assertRedirect(route('orders.index'));

        $this->assertDatabaseHas('payments', [
            'name' => 'Ana',
            'document' => '123456789',
            'email' => 'admin@example.com',
            'mobile' => '23456789',
            'totalStore' => '2345678',
        ]);

        $this->assertAuthenticatedAs($this->user);
    }

    public function testStorePayErrors(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('orders.paymentInStore'), []);

        $response
            ->assertSessionHasErrors([
                'name',
                'document',
                'email',
                'mobile',
                'totalStore',
            ]);

        $this->assertAuthenticatedAs($this->user);
    }
}
