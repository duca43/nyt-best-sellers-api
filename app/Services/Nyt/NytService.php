<?php

namespace App\Services\Nyt;

use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class NytService
{
    const LISTS_ERROR_STATUS = 'ERROR';

    /**
     * Handle the response from a lists endpoint.
     *
     * Process JSON response from a `/lists` endpoint. Check for specific rate limit error.
     * Check for common errors as well. If there are no errors, extract data if available.
     *
     * @param  Illuminate\Http\Client\Response  $response The HTTP response from the `/lists` endpoint.
     * @return array Returns an array containing data and total number of results.
     * @throws Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException
     *                 Thrown if the API returns a rate limit exceeded error.
     * @throws Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     *                 Thrown if the API returns an error status indicating that the list data is not available.
     */
    protected function handleListsResponse(Response $response): array
    {
        $json = $response->json();

        if (array_key_exists('fault', $json)) {
            throw new TooManyRequestsHttpException(null, $json['fault']['faultstring'] ?? 'Rate limit is exceeded.');
        }

        if (array_key_exists('status', $json) && $json['status'] === self::LISTS_ERROR_STATUS) {
            throw new BadRequestHttpException($json['errors'][0] ?? 'List data is not available.');
        }

        return [
            'data' => $json['results'] ?? [],
            'total' => $json['num_results'] ?? 0
        ];
    }
}
