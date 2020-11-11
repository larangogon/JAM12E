<?php

namespace App\Rules;

use App\Entities\Color;
use Illuminate\Contracts\Validation\Rule;

class RuleColor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
        return 'Color does not exist in the database';
    }
}
