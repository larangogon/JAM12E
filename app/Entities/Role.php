<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    use HasRoles;

    protected $guarded = [];
}
