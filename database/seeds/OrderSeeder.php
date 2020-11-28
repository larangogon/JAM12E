<?php

use App\Entities\Detail;
use App\Entities\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        factory(Order::class, 100)->create();
        Order::inRandomOrder()->each(function ($order) {
            factory(Detail::class, rand(1, 2))->create([
                'order_id' => $order->id,
            ]);

            if ($order->status === 'APPROVED') {
                Detail::inRandomOrder()->each(function ($detail) {
                    $detail->check = 'vendido';
                    $detail->save();
                });
            }
        });
    }
}
