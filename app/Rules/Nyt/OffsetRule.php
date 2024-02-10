<?php

namespace App\Rules\Nyt;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OffsetRule implements ValidationRule
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

        if ($value % 20 !== 0) {
            $fail('Offset must be a multiple of 20');
        }
    }
}
