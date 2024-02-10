<?php

namespace App\Services\Nyt\Clients;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractNytApiClient
{
    public function prepareRequest(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl())
            ->withQueryParameters($this->queryParameters())
            ->acceptJson();
    }

    abstract protected function baseUrl(): string;

    abstract protected function queryParameters(): array;
}
