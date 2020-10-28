<?php

namespace App\Rules;

use App\Entities\Size;
use Illuminate\Contracts\Validation\Rule;

class SizeRule implements Rule
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

        foreach ($values as $value) {
            $size = Size::where('name', $value)->first();

            if ($size) continue;
            $pase = true;
            break;
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
        return 'The validation error message.';
    }
}
