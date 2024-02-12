# NYT Best Sellers List & Filter

## Purpose

This repository contains assessment purpose code for the NYT Best Sellers List & Filter API, a Laravel JSON-based API that retrieves data from the [NYT Books API](https://developer.nytimes.com/docs/books-product/1/overview).

This API exposes [/lists/best-sellers/history.json](https://developer.nytimes.com/docs/books-product/1/routes/lists/best-sellers/history.json/get) endpoint for retrieving best sellers list history.

## Features
* Retrieve a best sellers list history from the New York Times Books API.
* Filter books by `author`, `ISBN`, `title`.
* Paginate using `offset` field

## Run locally
To run API locally, follow these steps:

1. Clone this repository to your local machine.
2. Install dependencies using Composer:
```bash
composer install
```
3. Set up your environment variables by copying the `.env.example` file to `.env` and configuring it with your [NYT API credentials](https://developer.nytimes.com/my-apps).

4. Start the Laravel development server:
```bash
php artisan serve
```
5. Access the API at http://localhost:8000/api/v1/nyt/best-sellers.

## Run tests

To run unit tests for the API, use PHPUnit. Ensure that you have PHPUnit installed and configured.
Then, run the following command:
```bash
php artisan test
```
