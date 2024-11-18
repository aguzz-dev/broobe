<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Http\Requests\MetricRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class GooglePageSpeedController extends Controller
{
    public function getMetrics(MetricRequest $request)
    {
        if (!preg_match('/\.(com|es|net|org|edu|gov|int|co|info|biz|mobi)$/i', $request->url)) {
            return response()->json([
                'error' => 'La URL debe terminar con un dominio válido como .com, .es, .net, entre otros.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
        $url = $this->buildUrl($request);
        $metricsData = $this->getApiData($url);
        return response()->json($metricsData, JsonResponse::HTTP_OK);
    }

    private function buildUrl($request): string
    {
        $apiUrl = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?';
        $urlParameter = 'url=https://' . $request->url;
        $apiKeyParameter = '&key=' . env('GOOGLE_API_KEY');
        $categoriesParameter = $this->filterCategories($request);
        $strategyParameter = '&strategy=' . $request->strategy;

        return $apiUrl . $urlParameter . $apiKeyParameter . $categoriesParameter . $strategyParameter;
    }

    private function filterCategories($request): string
    {
        $possibleCategories = [
            'pwa',
            'seo',
            'performance',
            'best_practices',
            'accessibility',
        ];

        $filteredCategories = array_filter($possibleCategories, fn($category) => $request->input($category));

        $categoriesQueryString = '&' . implode('&', array_map(function ($category) {
            return 'category=' . strtoupper($category);
        }, $filteredCategories));

        return $categoriesQueryString;
    }

    private function getApiData($url)
    {
        try {
            $response = (new Client)->request('GET', $url);
            $data = json_decode($response->getBody(), true);
            $categories = $data['lighthouseResult']['categories'];
            $dataFormatted = array_map(function ($category) {
                return [
                    'id' => $category['id'],
                    'title' => $category['title'],
                    'score' => $category['score'],
                ];
            }, $categories);

            return $dataFormatted;
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}
