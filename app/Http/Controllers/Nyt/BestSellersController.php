<?php

namespace App\Http\Controllers\Nyt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Nyt\BestSellersRequest;
use App\Http\Resources\Nyt\BestSellerResource;
use App\Services\Nyt\BestSellersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class BestSellersController extends Controller
{
    public function __construct(private BestSellersService $bestSellersService)
    {
    }

    /**
     * Retrieve the best sellers data and return it as a JSON response.
     *
     * @param  \App\Http\Requests\BestSellersRequest $request The incoming request containing the query parameters.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response containing the best sellers data or an error message.
     */
    public function index(BestSellersRequest $request): JsonResponse
    {
        $queryParams = $request->validated();

        try {
            $bestSellers = $this->bestSellersService->getBestSellers($queryParams);
            return BestSellerResource::collection($bestSellers)->response();
        } catch (TooManyRequestsHttpException $e) {
            return response()->json(['message' => $e->getMessage()], 429);
        } catch (HttpException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
