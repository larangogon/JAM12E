<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['id', 'name', 'description', 'price', 'stock', 'active', 'created_by', 'updated_by'];

    /**
     * @return HasMany
     */
    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'product_id');
    }

    /**
     * @param array|null $files
     * @param int $product_id
     */
    public function asignarImagen(?array $files, int $product_id)
    {
        if (!$files) {
            return;
        }
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $name);

            $imagen = new Imagen();

            $imagen->name       = $name;
            $imagen->product_id = $product_id;

            $imagen->save();
        }
    }

    /**
     * @return mixed
     */
    public function tieneImagen()
    {
        return $this->imagenes->flatten()->pluck('name')->unique();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
    }

    /**
     * @param $query
     * @param $category
     */
    public function scopeCategory($query, $category)
    {
        if (empty($category)) {
            return;
        }

        return  $query->whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }

    /**
     * @return BelongsToMany
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    /**
     * @param $color
     */
    public function asignarColor($color): void
    {
        $this->colors()->sync($color, false);
    }

    /**
     * @return mixed
     */
    public function tieneColor()
    {
        return $this->colors->flatten()->pluck('name')->unique();
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @param $category
     */
    public function asignarCategory($category): void
    {
        $this->categories()->sync($category, false);
    }

    /**
     * @return mixed
     */
    public function tieneCategory()
    {
        return $this->categories->flatten()->pluck('name')->unique();
    }

    /**
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class)->withTimestamps();
    }

    /**
     * @param $size
     */
    public function asignarSize($size): void
    {
        $this->sizes()->sync($size, false);
    }

    /**
     * @return mixed
     */
    public function tieneSize()
    {
        return $this->sizes->flatten()->pluck('name')->unique();
    }

    /**
     * @return BelongsToMany
     */
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'in_carts')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getCacheProducts()
    {
        return Cache::remember('products', now()->addDay(), function () {
            return $this->all();
        });
    }

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
}
