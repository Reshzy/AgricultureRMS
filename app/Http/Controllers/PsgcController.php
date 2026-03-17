<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PsgcController extends Controller
{
    public function regions(): JsonResponse
    {
        try {
            $data = Cache::remember('psgc:regions', 86400, function () {
                $client = Http::timeout(10);
                if (in_array(config('app.env'), ['local', 'testing'])) {
                    $client = $client->withoutVerifying();
                }
                $res = $client->get('https://psgc.gitlab.io/api/regions/');
                $res->throw();

                return $res->json();
            });

            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch regions'], 502);
        }
    }

    public function provincesByRegion(string $regionCode): JsonResponse
    {
        try {
            $key = "psgc:region:$regionCode:provinces";
            $data = Cache::remember($key, 86400, function () use ($regionCode) {
                $client = Http::timeout(10);
                if (in_array(config('app.env'), ['local', 'testing'])) {
                    $client = $client->withoutVerifying();
                }
                $res = $client->get("https://psgc.gitlab.io/api/regions/{$regionCode}/provinces/");
                $res->throw();

                return $res->json();
            });

            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch provinces'], 502);
        }
    }

    public function citiesByProvince(string $provinceCode): JsonResponse
    {
        try {
            $key = "psgc:province:$provinceCode:cities";
            $data = Cache::remember($key, 86400, function () use ($provinceCode) {
                $client = Http::timeout(10);
                if (in_array(config('app.env'), ['local', 'testing'])) {
                    $client = $client->withoutVerifying();
                }
                $res = $client->get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/cities-municipalities/");
                $res->throw();

                return $res->json();
            });

            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch cities/municipalities'], 502);
        }
    }

    public function barangaysByCity(string $cityCode): JsonResponse
    {
        try {
            $key = "psgc:city:$cityCode:barangays";

            $fetchBarangays = function () use ($cityCode): array {
                $client = Http::timeout(10);
                if (in_array(config('app.env'), ['local', 'testing'])) {
                    $client = $client->withoutVerifying();
                }

                $endpoints = [
                    "https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays/",
                    "https://psgc.gitlab.io/api/municipalities/{$cityCode}/barangays/",
                    "https://psgc.gitlab.io/api/cities/{$cityCode}/barangays/",
                ];

                $lastJson = [];

                foreach ($endpoints as $endpoint) {
                    $res = $client->get($endpoint);
                    $res->throw();
                    $json = $res->json();
                    $lastJson = is_array($json) ? $json : [];

                    if (is_array($json) && count($json) > 0) {
                        return $json;
                    }
                }

                return $lastJson;
            };

            $data = Cache::get($key);
            if (! is_array($data) || count($data) === 0) {
                // Refetch when cache is missing/empty so a previously-cached empty
                // result from a flaky upstream call never permanently blocks the dropdown.
                $fresh = $fetchBarangays();

                if (count($fresh) > 0) {
                    Cache::put($key, $fresh, 86400);
                    $data = $fresh;
                } else {
                    Cache::forget($key);
                    $data = $fresh;
                }
            }

            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch barangays'], 502);
        }
    }
}
