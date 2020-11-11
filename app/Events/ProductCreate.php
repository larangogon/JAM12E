<?php

namespace App\Events;

use App\Entities\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCreate
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $product;

    /**
     * OrderIsCreated constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
