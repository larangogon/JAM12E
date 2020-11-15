<?php

namespace App\Entities;

use App\Utils\CanBeRate;
use App\Utils\CanRate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;
    use CanRate;
    use CanBeRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cellphone',
        'document',
        'address',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @param $role
     */
    public function asignarRol($role): void
    {
        $this->roles()
            ->sync($role, false);
    }

    /**
     * @return mixed
     */
    public function tieneRol()
    {
        return $this->roles
            ->flatten()
            ->pluck('name')
            ->unique();
    }

    /**
     * @return HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return mixed
     */
    public function getCacheUser()
    {
        return Cache::remember('users', now()->addDay(), function () {
            return $this->all();
        });
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
     * @param $role
     */
    public function scopeRole($query, $role)
    {
        if (empty($role)) {
            return;
        }

        return  $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    /**
     * @return HasMany
     */
    public function productsUpdate(): HasMany
    {
        return $this->hasMany(Product::class, 'updated_by');
    }

    /**
     * @return HasMany
     */
    public function cancellers(): HasMany
    {
        return $this->hasMany(Cancelled::class, 'cancelled_by');
    }

    /**
     * @return HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'created_by');
    }

    /**
     * @return HasMany
     */
    public function messagesRecipient(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * @return HasMany
     */
    public function messagesSender(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * @return HasMany
     */
    public function spending(): HasMany
    {
        return $this->hasMany(Spending::class, 'created_by');
    }

    /**
     * @return HasMany
     */
    public function spendingUpdate(): HasMany
    {
        return $this->hasMany(Spending::class, 'updated_by');
    }
}
