<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class DummyJsonController extends Controller
{
    public function __invoke(SearchRequest $request): JsonResponse
    {
        $baseUrl = config('dummy_json.base_url');
        $entity = $request->input('entity');
        $searchQuery = $request->input('search_query');

        try {
            $request = Http::get("$baseUrl/$entity/search", [
                'q' => $searchQuery
            ]);

            $data = $request->json()[$entity];

            switch ($entity) {
                case 'products':
                    $this->processProducts($data);
                    break;

                case 'recipes':
                    $this->processRecipes($data);
                    break;

                case 'posts':
                    $this->processPosts($data);
                    break;
            }



        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true]);

    }

    private function processProducts($data): void
    {

        foreach ($data as $item) {
            Product::query()->updateOrCreate(
                [
                    'sku' => $item['sku']
                ],
                [
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'category' => $item['category'],
                    'rating' => $item['rating'],
                    'brand' => $item['brand'],
                    'price' => $item['price'],
                    'weight' => $item['weight'],
                    'sku' => $item['sku'],
                ]
            );
        }
    }
    private function processRecipes($data): void
    {
        foreach ($data as $item) {
            Recipe::query()->updateOrCreate(
                [
                    'name' => $item['name']
                ],
                [
                    'name' => $item['name'],
                    'сook_time' => $item['cookTimeMinutes'],
                    'difficulty' => $item['difficulty'],
                    'rating' => $item['rating'],
                    'ingredients' => $item['ingredients'],
                    'cousin' => $item['cuisine'],
                ]
            );
        }
    }

    private function processPosts($data): void
    {
        foreach ($data as $item) {
            Recipe::query()->updateOrCreate(
                [
                    'id' => $item['id']
                ],
                [
                    'name' => $item['name'],
                    'body' => $item['body'],
                    'tags' => $item['tags'],
                    'views' => $item['views'],
                ]
            );
        }
    }
}


