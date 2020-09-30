<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = [];

    protected $fillable =
        ['order_id', 'requestId', 'status', 'processUrl', 'amount', 'internalReference',
        'internalReference', 'processUrl', 'message', 'document', 'name', 'email', 'mobile', 'locale'
        ];

    protected $table = 'payments';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo('App\Order');
    }
}
