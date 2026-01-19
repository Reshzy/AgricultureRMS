<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PsgcController extends Controller
{
    public function regions()
    {
        try {
            $data = Cache::remember('psgc:regions', 86400, function () {
                $res = Http::timeout(10)->get('https://psgc.gitlab.io/api/regions/');
                $res->throw();
                return $res->json();
            });
            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch regions'], 502);
        }
    }

    public function provincesByRegion(string $regionCode)
    {
        try {
            $key = "psgc:region:$regionCode:provinces";
            $data = Cache::remember($key, 86400, function () use ($regionCode) {
                $res = Http::timeout(10)->get("https://psgc.gitlab.io/api/regions/{$regionCode}/provinces/");
                $res->throw();
                return $res->json();
            });
            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch provinces'], 502);
        }
    }

    public function citiesByProvince(string $provinceCode)
    {
        try {
            $key = "psgc:province:$provinceCode:cities";
            $data = Cache::remember($key, 86400, function () use ($provinceCode) {
                $res = Http::timeout(10)->get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/cities-municipalities/");
                $res->throw();
                return $res->json();
            });
            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch cities/municipalities'], 502);
        }
    }

    public function barangaysByCity(string $cityCode)
    {
        try {
            $key = "psgc:city:$cityCode:barangays";
            $data = Cache::remember($key, 86400, function () use ($cityCode) {
                $res = Http::timeout(10)->get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays/");
                $res->throw();
                return $res->json();
            });
            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to fetch barangays'], 502);
        }
    }
}


