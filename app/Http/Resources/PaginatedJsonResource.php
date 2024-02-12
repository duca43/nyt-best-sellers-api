<?php

namespace App\Http\Resources;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedJsonResource extends JsonResource
{
    /**
     * Create a new anonymous resource collection.
     *
     * Extend creation of anonymous resource collection with
     * additional meta data related to pagination.
     *
     * @param  mixed  $resource
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public static function collection($resource)
    {
        $collection = parent::collection($resource['data']);

        $perPage = config('nyt.books_api_default_per_page');
        $offset = request('offset') ?? 0;
        $currentPage = $offset / $perPage + 1;

        if (empty($resource['data'])) {
            $currentPage = 1;
            $from = null;
            $to = null;
            $lastPage = 1;
        } else {
            $currentPage = $offset / $perPage + 1;
            $from = ($currentPage - 1) * $perPage + 1;
            $to =  min($currentPage * $perPage, $resource['total']);
            $lastPage = ceil($resource['total'] / $perPage);
        }

        return $collection->additional([
            'meta' => [
                'currentPage' => $currentPage,
                'from' => $from,
                'lastPage' => $lastPage,
                'perPage' => $perPage,
                'to' => $to,
                'total' => $resource['total']
            ]
        ]);
    }
}
