<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model
{
    protected $table = 'shippings';

    protected $fillable = [
        'name_recipient', 'phone_recipient',
        'cellphone_recipient', 'document_recipient',
        'address_recipient', 'email_recipient',
        'country_recipient', 'city_recipient', 'order_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
