<?php

namespace App\Entities;

use App\Utils\CanBeRate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use CanBeRate;

    protected $guarded = [];

    protected $table = 'products';

    protected $fillable = [
        'id',
        'barcode',
        'name',
        'sales',
        'description',
        'price',
        'stock',
        'active',
        'visits',
        'created_by',
        'updated_by',
    ];

    /**
     * @return HasMany
     */
    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'product_id');
    }

    public function assignImage(?array $files, int $product_id)
    {
        if (!$files) {
            return;
        }
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $name);

            $imagen = new Imagen();

            $imagen->name = $name;
            $imagen->product_id = $product_id;

            $imagen->save();
        }
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%")
                ->orWhere('barcode', 'LIKE', "%$search%");
        }
    }

    public function scopeCategory($query, $category)
    {
        if (empty($category)) {
            return;
        }

        return  $query->whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    public function assignColor($color): void
    {
        $this->colors()->sync($color, false);
    }

    public function hasColor()
    {
        return $this->colors
            ->flatten()
            ->pluck('name')
            ->unique();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function assignCategory($category): void
    {
        $this->categories()->sync($category, false);
    }

    public function hasCategory()
    {
        return $this->categories
            ->flatten()
            ->pluck('name')
            ->unique();
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class)->withTimestamps();
    }

    public function assignSize($size): void
    {
        $this->sizes()->sync($size, false);
    }

    public function hasSize()
    {
        return $this->sizes->flatten()
            ->pluck('name')
            ->unique();
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'in_carts')->withTimestamps();
    }

    public function userCreate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function userUpdate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function barcode(): HasMany
    {
        return $this->hasMany(Spending::class, 'barcode');
    }
}
