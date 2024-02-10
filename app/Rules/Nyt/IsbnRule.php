<?php

namespace App\Rules\Nyt;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsbnRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value) {
            return;
        }

        if (!in_array(strlen($value), [10, 13])) {
            $fail('ISBN has to be either 10 or 13 characters long.');
        }
    }
}
