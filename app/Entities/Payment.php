<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'order_id',
        'requestId',
        'status',
        'processUrl',
        'amount',
        'internalReference',
        'internalReference',
        'processUrl',
        'message',
        'document',
        'name',
        'email',
        'mobile',
        'locale',
        'base',
        'totalStore',
        'expiration'
        ];

    protected $table = 'payments';

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo('App\Entities\Order');
    }
}
