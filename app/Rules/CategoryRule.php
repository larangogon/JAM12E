<?php

namespace App\Rules;

use App\Entities\Category;
use Illuminate\Contracts\Validation\Rule;

class CategoryRule implements Rule
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

        $paso = true;

        foreach ($values as $value) {
            $category = Category::where('name', $value)->first();

            if (!$category) {
                $paso = false;
                break;
            }
        }

        return $paso;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Category does not exist in the database';
    }
}
