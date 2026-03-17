<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PsgcControllerTest extends TestCase
{
    public function test_barangays_endpoint_falls_back_when_cities_municipalities_returns_empty(): void
    {
        Cache::flush();

        $cityCode = '021511000';

        Http::fake([
            "https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays/" => Http::response([], 200),
            "https://psgc.gitlab.io/api/municipalities/{$cityCode}/barangays/" => Http::response([
                ['code' => '021511001', 'name' => 'Test Barangay 1'],
                ['code' => '021511002', 'name' => 'Test Barangay 2'],
            ], 200),
        ]);

        $this->getJson("/api/psgc/cities/{$cityCode}/barangays")
            ->assertOk()
            ->assertJsonCount(2)
            ->assertJsonFragment(['name' => 'Test Barangay 1']);
    }

    public function test_barangays_endpoint_does_not_keep_empty_cached_results(): void
    {
        Cache::flush();

        $cityCode = '021511000';
        Cache::put("psgc:city:$cityCode:barangays", [], 86400);

        Http::fake([
            "https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays/" => Http::response([], 200),
            "https://psgc.gitlab.io/api/municipalities/{$cityCode}/barangays/" => Http::response([
                ['code' => '021511001', 'name' => 'Recovered Barangay'],
            ], 200),
        ]);

        $this->getJson("/api/psgc/cities/{$cityCode}/barangays")
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => 'Recovered Barangay']);
    }
}
