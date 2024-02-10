<?php

namespace App\Http\Requests\Nyt;

use App\Rules\Nyt\IsbnRule;
use App\Rules\Nyt\OffsetRule;
use Illuminate\Foundation\Http\FormRequest;

class BestSellersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => 'string',
            'isbn' => 'array',
            'isbn.*' =>  new IsbnRule(),
            'title' => 'string',
            'offset' => ['integer', new OffsetRule()]
        ];
    }
}
