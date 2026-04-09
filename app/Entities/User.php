<?php

namespace App\Entities;

use App\Utils\CanBeRate;
use App\Utils\CanRate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;
    use CanRate;
    use CanBeRate;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cellphone',
        'document',
        'address',
        'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @param $role
     */
    public function asignarRol($role): void
    {
        $this->roles()->sync($role, false);
    }

    public function tieneRol()
    {
        return $this->roles
            ->flatten()
            ->pluck('name')
            ->unique();
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
    }

    public function scopeRole($query, $role)
    {
        if (empty($role)) {
            return;
        }

        return  $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function productsUpdate(): HasMany
    {
        return $this->hasMany(Product::class, 'updated_by');
    }

    public function cancellers(): HasMany
    {
        return $this->hasMany(Cancelled::class, 'cancelled_by');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'created_by');
    }

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
