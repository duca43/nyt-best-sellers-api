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

        $perPage = config('nyt.books_api_default_per_page');

        if ($value % $perPage !== 0) {
            $fail("Offset must be a multiple of $perPage");
        }
    }
}
