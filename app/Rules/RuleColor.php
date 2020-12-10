<?php

namespace App\Rules;

use App\Entities\Color;
use Illuminate\Contracts\Validation\Rule;

class RuleColor implements Rule
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
            $color = Color::where('name', $value)->first();

            if (!$color) {
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
        return 'El color no existe en la base de datos';
    }
}
