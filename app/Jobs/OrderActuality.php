<?php

namespace App\Jobs;

use App\Entities\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderActuality implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $order;

    /**
     * OrderActuality constructor.
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        if ($this->order->status === 'APPROVED') {
            foreach ($this->order->details as $details) {
                $details->check = 'vendido';
                $details->save();

                $detail = $details->product_id;

                $product = Product::where('id', '=', $detail)
                    ->firstOrFail();

                $product->sales += 1;
                $product->stock -= $details->stock;

                $product->save();

                if ($product->stock == '0') {
                    $product->active = '0';
                    $product->save();
                }
            }
        }
    }
}
