<?php

use App\Entities\Order;
use App\Entities\Payment;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 6)->create(['status' => 'APPROVED']);
        factory(Order::class, 3)->create(['status' => 'PENDING']);
        factory(Order::class, 2)->create(['status' => 'REJECTED']);

        Order::inRandomOrder()->each(function ($order) {
            factory(Payment::class)->create([
                'order_id' => $order->id,
                'status' => $order->status,
            ]);
        });
    }
}
