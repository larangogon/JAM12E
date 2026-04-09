<?php

namespace Tests\Feature;

use App\Entities\Cart;
use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Product;
use App\Entities\Size;
use App\Entities\User;
use Database\Seeders\PermissionsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PermissionsTableSeeder::class);

        $this->user = factory(User::class)->create([
            'active' => 1,
        ]);

        $this->user->assignRole('Administrator');

        $this->cart = new Cart();

        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testIndex()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('storefront.index'));

        $response
            ->assertStatus(200)
            ->assertViewHas(['products', 'search'])
            ->assertViewIs('storefront.index');
    }

    public function testShow()
    {
        $product = Product::create([
            'name' => 'new',
            'stock' => 56,
            'price' => 23456,
            'barcode' => '123243453545658',
            'description' => 'jdhfbgyebhsabfreahbfgy',
            'active' => 1,
        ]);

        $color = factory(Color::class)->create();
        $product->colors()->attach($color->id);

        $category = factory(Category::class)->create();
        $product->categories()->attach($category->id);

        $size = factory(Size::class)->create();
        $product->sizes()->attach($size->id);

        $response = $this->actingAs($this->user, 'web')
            ->get(route('storefront.show', $product->id));

        $response
            ->assertStatus(200)
            ->assertViewHas([
                'product',
                'average',
                'total',
                'averageScore',
            ])
            ->assertViewIs('storefront.show');

        $this->assertAuthenticatedAs($this->user);
    }
}
