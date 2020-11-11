<?php

namespace Tests\Feature;

use App\Entities\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function orderP2p()
    {

        factory(Order::class, 1)->create([
            'id' => 1,
                'status' => 'PENDING',
            ]
        );

        $this->artisan('payment:orders');

        $this->assertDatabaseHas('orders', [
            'id' => 1,
            'status' => 'APPROVED'
        ]);
    }
}
