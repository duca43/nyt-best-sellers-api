<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BestSellersTest extends TestCase
{
    private $getBestSellersEndpoint = 'nyt.best-sellers';

    public function testGettingBestSellers(): void
    {
        $responseData = Storage::get('nyt/best_sellers_success.json');

        Http::fake([
            config('nyt.books_api_base_url') . '/lists/best-sellers/history.json?*' => Http::response($responseData)
        ]);

        $response = $this->getJson(route($this->getBestSellersEndpoint));

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                [
                    'title' => '$100 STARTUP',
                    'description' => 'How to build a profitable start up for $100 or less and be your own boss.',
                    'contributor' => 'by Chris Guillebeau',
                    'author' => 'Chris Guillebeau',
                    'contributorNote' => '',
                    'price' => '23.00',
                    'ageGroup' => '',
                    'publisher' => 'Crown Business',
                    'isbns' => [
                        '0307951529',
                        '9780307951526'
                    ],
                    'ranksHistory' => [],
                    'reviews' => [
                        [
                            'book_review_link' => '',
                            'first_chapter_link' => '',
                            'sunday_review_link' => '',
                            'article_chapter_link' => ''
                        ]
                    ]
                ]
            ],
            'meta' => [
                'currentPage' => 1,
                'from' => 1,
                'lastPage' => 1,
                'perPage' => 20,
                'to' => 5,
                'total' => 5
            ]
        ]);
    }

    public function testGettingBestSellersWithOffset(): void
    {
        $responseData = Storage::get('nyt/best_sellers_success_with_offset.json');

        Http::fake([
            config('nyt.books_api_base_url') . '/lists/best-sellers/history.json?*' => Http::response($responseData)
        ]);

        $response = $this->getJson(route($this->getBestSellersEndpoint, ['offset' => 20]));

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                [
                    'title' => '$100 STARTUP',
                    'description' => 'How to build a profitable start up for $100 or less and be your own boss.',
                    'contributor' => 'by Chris Guillebeau',
                    'author' => 'Chris Guillebeau',
                    'contributorNote' => '',
                    'price' => '23.00',
                    'ageGroup' => '',
                    'publisher' => 'Crown Business',
                    'isbns' => [
                        '0307951529',
                        '9780307951526'
                    ],
                    'ranksHistory' => [],
                    'reviews' => [
                        [
                            'book_review_link' => '',
                            'first_chapter_link' => '',
                            'sunday_review_link' => '',
                            'article_chapter_link' => ''
                        ]
                    ]
                ]
            ],
            'meta' => [
                'currentPage' => 2,
                'from' => 21,
                'lastPage' => 2,
                'perPage' => 20,
                'to' => 22,
                'total' => 22
            ]
        ]);
    }

    public function testGettingBestSellersByTitleAndAuthor(): void
    {
        $responseData = Storage::get('nyt/best_sellers_success_by_title_and_author.json');

        Http::fake([
            config('nyt.books_api_base_url') . '/lists/best-sellers/history.json?*' => Http::response($responseData)
        ]);

        $response = $this->getJson(
            route(
                $this->getBestSellersEndpoint,
                [
                    'title' => '100',
                    'author' => 'Brian'
                ]
            )
        );

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                [
                    "title" => "100 BULLETS DELUXE, BOOK 1",
                    "description" => "This deluxe edition of the noir series, about a man named Graves who gives wronged people an untraceable gun to exact revenge, collects issues 20 through 36.",
                    "contributor" => "by Brian Azzarello and Eduaro Risso",
                    "author" => "Brian Azzarello and Eduaro Risso",
                    "contributorNote" => "",
                    "price" => "49.99",
                    "ageGroup" => "",
                    "publisher" => "DC Comics",
                    "isbns" => [],
                    "ranksHistory" => [
                        [
                            "primary_isbn10" => "None",
                            "primary_isbn13" => "9781401233723",
                            "rank" => 6,
                            "list_name" => "Hardcover Graphic Books",
                            "display_name" => "Hardcover Graphic Books",
                            "published_date" => "2012-05-06",
                            "bestsellers_date" => "2012-04-21",
                            "weeks_on_list" => 1,
                            "rank_last_week" => 0,
                            "asterisk" => 0,
                            "dagger" => 0
                        ]
                    ],
                    "reviews" => [
                        [
                            "book_review_link" => "",
                            "first_chapter_link" => "",
                            "sunday_review_link" => "",
                            "article_chapter_link" => ""
                        ]
                    ]
                ]
            ],
            'meta' => [
                'currentPage' => 1,
                'from' => 1,
                'lastPage' => 1,
                'perPage' => 20,
                'to' => 5,
                'total' => 5
            ]
        ]);
    }

    public function testGettingBestSellersByIsbn(): void
    {
        $responseData = Storage::get('nyt/best_sellers_success_by_isbn.json');

        Http::fake([
            config('nyt.books_api_base_url') . '/lists/best-sellers/history.json?*' => Http::response($responseData)
        ]);

        $response = $this->getJson(
            route(
                $this->getBestSellersEndpoint,
                [
                    'isbn' => ['9781401232016']
                ]
            )
        );

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                [
                    "title" => "100 BULLETS: BOOK ONE",
                    "description" => "This deluxe edition of the noir series, about a man named Graves who gives wronged people an untraceable gun to exact revenge, collects issues 1 through 19.",
                    "contributor" => "by Brian Azzarello and Eduardo Risso",
                    "author" => "Brian Azzarello and Eduardo Risso",
                    "contributorNote" => "",
                    "price" => "49.99",
                    "ageGroup" => "",
                    "publisher" => "DC Comics",
                    "isbns" => [
                        "1401232019",
                        "9781401232016"
                    ],
                    "ranksHistory" => [
                        [
                            "primary_isbn10" => "1401232019",
                            "primary_isbn13" => "9781401232016",
                            "rank" => 8,
                            "list_name" => "Hardcover Graphic Books",
                            "display_name" => "Hardcover Graphic Books",
                            "published_date" => "2011-11-13",
                            "bestsellers_date" => "2011-10-29",
                            "weeks_on_list" => 2,
                            "rank_last_week" => 0,
                            "asterisk" => 0,
                            "dagger" => 0
                        ],
                        [
                            "primary_isbn10" => "1401232019",
                            "primary_isbn13" => "9781401232016",
                            "rank" => 6,
                            "list_name" => "Hardcover Graphic Books",
                            "display_name" => "Hardcover Graphic Books",
                            "published_date" => "2011-11-06",
                            "bestsellers_date" => "2011-10-22",
                            "weeks_on_list" => 1,
                            "rank_last_week" => 0,
                            "asterisk" => 0,
                            "dagger" => 0
                        ]
                    ],
                    "reviews" => [
                        [
                            "book_review_link" => "",
                            "first_chapter_link" => "",
                            "sunday_review_link" => "",
                            "article_chapter_link" => ""
                        ]
                    ]
                ]
            ],
            'meta' => [
                'currentPage' => 1,
                'from' => 1,
                'lastPage' => 1,
                'perPage' => 20,
                'to' => 1,
                'total' => 1
            ]
        ]);
    }

    public function testGettingBestSellersWithInvalidOffsetAndIsbnValue()
    {
        $response = $this->getJson(
            route(
                $this->getBestSellersEndpoint,
                [
                    'isbn' => ['SHORTISBN'],
                    'offset' => config('nyt.books_api_default_per_page') + 1
                ]
            )
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['offset', 'isbn.0']);
    }

    public function testGettingBestSellersWithInvalidIsbnType()
    {
        $response = $this->getJson(
            route(
                $this->getBestSellersEndpoint,
                [
                    'isbn' => '9781401232016'
                ]
            )
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isbn']);
    }

    public function testRateLimitExceededWhileGettingBestSellers()
    {
        $responseData = Storage::get('nyt/best_sellers_rate_limit_error.json');

        Http::fake([
            config('nyt.books_api_base_url') . '/lists/best-sellers/history.json?*' => Http::response($responseData)
        ]);

        $response = $this->getJson(route($this->getBestSellersEndpoint));

        $response->assertStatus(429);
        $response->assertJson(['message' => 'Rate limit quota violation. Quota limit  exceeded. Identifier : 09f129ab-1adb-44d8-b77c-ac3d515b6669']);
    }

    public function testInternalFailureWhileGettingBestSellers()
    {
        $responseData = Storage::get('nyt/best_sellers_internal_error.json');

        Http::fake([
            config('nyt.books_api_base_url') . '/lists/best-sellers/history.json?*' => Http::response($responseData)
        ]);

        $response = $this->getJson(route($this->getBestSellersEndpoint));

        $response->assertStatus(500);
        $response->assertJson(['message' => 'No list found for list name and/or date provided.']);
    }
}
