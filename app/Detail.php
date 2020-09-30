<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    protected $guarded = [];

    protected $table = 'details';

    protected $fillable = [
        'total','stock','color_id','size_id','product_id', 'order_id'
    ];

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * @return BelongsTo
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
