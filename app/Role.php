<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    use HasRoles;

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function getCacheRoles()
    {
        return Cache::remember('roles', now()->addDay(), function () {
            return $this->all();
        });
    }
}
