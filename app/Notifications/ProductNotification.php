<?php

namespace App\Notifications;

use App\Entities\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductNotification extends Notification
{
    use Queueable;

    /**
     * @var Product
     */
    private $product;

    /**
     * ProductNotification constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id'    => $this->product->id,
            'name'  => $this->product->name,
            'stock' => $this->product->stock,
        ];
    }
}
