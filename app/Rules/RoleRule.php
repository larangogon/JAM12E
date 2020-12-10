<?php

namespace App\Rules;

use App\Entities\Role;
use Illuminate\Contracts\Validation\Rule;

class RoleRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $values = explode(',', $value);

        $pase = true;

        foreach ($values as $value) {
            $role = Role::where('name', $value)->first();

            if (!$role) {
                $pase = false;
                break;
            }
        }


        return $pase;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El Rol no existe en la base de datos';
    }
}
