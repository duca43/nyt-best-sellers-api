<?php

namespace App\Services\Nyt\Clients;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BooksApiClient extends AbstractNytApiClient
{
    protected function baseUrl(): string
    {
        return config('nyt.books_api_base_url');
    }

    protected function queryParameters(): array
    {
        return [
            'api-key' => config('nyt.books_api_key')
        ];
    }
}
