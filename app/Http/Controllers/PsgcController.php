<?php

namespace App\Http\Controllers;

use App\Models\PsgcBarangay;
use App\Models\PsgcCity;
use App\Models\PsgcProvince;
use App\Models\PsgcRegion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PsgcController extends Controller
{
    public function regions(): JsonResponse
    {
        try {
            $data = Cache::remember('psgc:regions', 86400, function () {
                return PsgcRegion::query()
                    ->orderBy('name')
                    ->get()
                    ->map(fn (PsgcRegion $region): array => [
                        'code' => $region->code,
                        'name' => $region->name,
                        'regionName' => $region->region_name ?? '',
                        'islandGroupCode' => $region->island_group_code ?? '',
                        'psgc10DigitCode' => $region->psgc_10_digit_code ?? '',
                    ])
                    ->all();
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
                return PsgcProvince::query()
                    ->where('region_code', $regionCode)
                    ->orderBy('name')
                    ->get()
                    ->map(fn (PsgcProvince $province): array => [
                        'code' => $province->code,
                        'name' => $province->name,
                        'regionCode' => $province->region_code,
                        'islandGroupCode' => $province->island_group_code ?? '',
                        'psgc10DigitCode' => $province->psgc_10_digit_code ?? '',
                    ])
                    ->all();
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
                return PsgcCity::query()
                    ->where('province_code', $provinceCode)
                    ->orderBy('name')
                    ->get()
                    ->map(fn (PsgcCity $city): array => [
                        'code' => $city->code,
                        'name' => $city->name,
                        'oldName' => $city->old_name ?? '',
                        'isCapital' => (bool) $city->is_capital,
                        'provinceCode' => $city->province_code ?? false,
                        'districtCode' => $city->district_code ?? false,
                        'regionCode' => $city->region_code,
                        'islandGroupCode' => $city->island_group_code ?? '',
                        'psgc10DigitCode' => $city->psgc_10_digit_code ?? '',
                    ])
                    ->all();
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

            $data = Cache::get($key);
            if (! is_array($data) || count($data) === 0) {
                $fresh = PsgcBarangay::query()
                    ->where('city_code', $cityCode)
                    ->orderBy('name')
                    ->get()
                    ->map(fn (PsgcBarangay $barangay): array => [
                        'code' => $barangay->code,
                        'name' => $barangay->name,
                        'oldName' => $barangay->old_name ?? '',
                        'regionCode' => $barangay->region_code,
                        'provinceCode' => $barangay->province_code ?? false,
                        'cityCode' => $barangay->city_code,
                        'islandGroupCode' => $barangay->island_group_code ?? '',
                        'psgc10DigitCode' => $barangay->psgc_10_digit_code ?? '',
                    ])
                    ->all();

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

    public function preload(Request $request): JsonResponse
    {
        $regionCode = (string) $request->query('region', '');
        $provinceCode = (string) $request->query('province', '');
        $cityCode = (string) $request->query('city', '');

        $key = sprintf('psgc:preload:%s:%s:%s', $regionCode, $provinceCode, $cityCode);

        try {
            $data = Cache::remember($key, 86400, function () use ($regionCode, $provinceCode, $cityCode): array {
                $regions = $this->regions()->getData(true);

                $provinces = $regionCode !== '' ? $this->provincesByRegion($regionCode)->getData(true) : [];
                $cities = $provinceCode !== '' ? $this->citiesByProvince($provinceCode)->getData(true) : [];
                $barangays = $cityCode !== '' ? $this->barangaysByCity($cityCode)->getData(true) : [];

                return [
                    'regions' => $regions,
                    'provinces' => $provinces,
                    'cities' => $cities,
                    'barangays' => $barangays,
                ];
            });

            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to preload PSGC'], 502);
        }
    }
}
