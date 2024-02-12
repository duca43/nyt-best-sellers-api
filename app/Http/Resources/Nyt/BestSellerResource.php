<?php

namespace App\Http\Resources\Nyt;

use App\Http\Resources\PaginatedJsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BestSellerResource extends PaginatedJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * Convert all snake case fields into camel case.
     *
     * Convert `isbns` array from
     * `
     * [
     *     {
     *         "isbn10": "1234567890",
     *         "isbn13": "1234567890123"
     *     }
     * ]
     * `
     * to
     * `
     * ["1234567890", "1234567890123"]
     * `
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this['title'],
            'description' => $this['description'],
            'contributor' => $this['contributor'],
            'author' => $this['author'],
            'contributorNote' => $this['contributor_note'],
            'price' => $this['price'],
            'ageGroup' => $this['age_group'],
            'publisher' => $this['publisher'],
            'isbns' => array_merge(...array_map(fn ($isbnGroup) => array_values($isbnGroup), $this['isbns'])),
            'ranksHistory' => $this['ranks_history'],
            'reviews' => $this['reviews']
        ];
    }
}
