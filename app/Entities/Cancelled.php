<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cancelled extends Model
{
    protected $fillable = ['user_id', 'statusTransaction', 'requestId', 'internalReference', 'processUrl' ,
        'message', 'document', 'name', 'email', 'mobile', 'locale', 'amountReturn', 'order_id', 'totalOrder'];

    protected $table = 'cancelleds';

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('user_id', 'LIKE', "%$search%");
        }
    }
}
