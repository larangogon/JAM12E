<?php

namespace App\Observers;

use App\Entities\Order;
use App\Entities\Product;
use App\Events\OrderIsCreated;

class OrderObserver
{
    /**
     * @param Order $order
     */
    public function updated(Order $order)
    {
        event(new OrderIsCreated($order));

        if($order->status == 'APPROVED'){
            foreach($order->details as $details) {
                $detail = $details->product_id;

                $product = Product::where('id', '=', $detail)
                    ->firstOrFail();
                $product->sales += 1;
                $product->save();
            }
        }
    }
}
