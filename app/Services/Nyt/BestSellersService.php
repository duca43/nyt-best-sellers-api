<?php

namespace App\Services\Nyt;

use App\Services\Nyt\Clients\BooksApiClient;
use Illuminate\Http\Client\Response;

class BestSellersService
{
    public function __construct(public BooksApiClient $client)
    {
    }

    public function getBestSellers(): Response
    {
        return $this->client
            ->prepareRequest()
            ->get('/lists/best-sellers/history.json');
    }
}
