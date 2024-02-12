<?php

namespace App\Services\Nyt;

use App\Services\Nyt\Clients\BooksApiClient;
use App\Services\Nyt\Traits\HandleNytResponseTrait;
use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BestSellersService extends NytService
{
    const BEST_SELLERS_PATH = '/lists/best-sellers/history.json';

    public function __construct(public BooksApiClient $client)
    {
    }

    /**
     * Get the best sellers data from the NYT Books API.
     *
     * Send GET request with the provided query parameters in order to fetch best sellers.
     * Process response using universal `handleListsResponse` method and propagate its return
     * value and thrown exceptions.
     *
     * @param  array  $queryParams Query parameters to be included in the request.
     * @return array|null Returns an array containing data if available, or null if data is not available.
     * @throws Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException
     *                 Thrown if the API returns a rate limit exceeded error.
     * @throws Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     *                 Thrown if the API returns an error status indicating that the list data is not available.
     */
    public function getBestSellers(array $queryParams): array
    {
        $response = $this->client
            ->prepareRequest()
            ->get(
                self::BEST_SELLERS_PATH,
                $this->transformQueryParams($queryParams)
            );

        return $this->handleListsResponse($response);
    }

    private function transformQueryParams(array $queryParams): array
    {
        if (!array_key_exists('isbn', $queryParams)) {
            return $queryParams;
        }

        return [
            ...$queryParams,
            'isbn' => implode(';', $queryParams['isbn'])
        ];
    }
}
