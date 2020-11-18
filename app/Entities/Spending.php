<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spending extends Model
{
    protected $guarded = [];

    protected $table = 'spendings';

    protected $fillable = [
        'id',
        'description',
        'total',
        'created_by',
        'updated_by',
        'barcode'
    ];

    /**
     * @return BelongsTo
     */
    public function userCreate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function userUpdate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'barcode');
    }

    /**
     * @param $query
     */
    public function scopeSpendinTotal($query)
    {
        $query->with('product')
            ->selectRaw('barcode, SUM(`total`) as total')
            ->groupBy('barcode')
            ->orderByDesc('total')
            ->limit(3);
    }
}
