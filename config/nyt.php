<?php

return [

    /*
    |--------------------------------------------------------------------------
    | New York Times Books API Base Url
    |--------------------------------------------------------------------------
    |
    | Base url for Books API provided by NYT used to fetch information
    | about book reviews and The New York Times Best Sellers lists.
    |
    */

    'books_api_base_url' => env('NYT_BOOKS_API_BASE_URL', 'https://api.nytimes.com/svc/books/v3'),

    /*
    |--------------------------------------------------------------------------
    | New York Times Books API Key
    |--------------------------------------------------------------------------
    |
    | Value used for API Key Authentication. When NYT Books API is being called,
    | API key is provided as a query parameter named 'api-key'.
    |
    */

    'books_api_key' => env('NYT_BOOKS_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | New York Times Books API Default per page value
    |--------------------------------------------------------------------------
    |
    | This value represents default number of results returned per page for
    | GET endpoints in Books API.
    |
    */

    'books_api_default_per_page' => 20
];
