<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Imagen extends Model
{
    protected $fillable = [
        'id',
        'name',
        'product_id'
    ];

    protected $table = 'imagenes';

    /**
     * @return BelongsToMany
     */
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
