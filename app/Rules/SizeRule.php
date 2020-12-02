<?php

namespace App\Rules;

use App\Entities\Size;
use Illuminate\Contracts\Validation\Rule;

class SizeRule implements Rule
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

        array_pop($values);

        $pase = true;

        foreach ($values as $value) {
            $size = Size::where('name', $value)->first();

            if (!$size) {
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
        return 'La talla no existe en la base de datos';
    }
}
