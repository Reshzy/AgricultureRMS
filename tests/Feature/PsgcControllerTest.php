<?php

namespace Tests\Feature;

use App\Models\PsgcBarangay;
use App\Models\PsgcCity;
use App\Models\PsgcProvince;
use App\Models\PsgcRegion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PsgcControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_regions_endpoint_returns_regions_from_db(): void
    {
        Cache::flush();

        PsgcRegion::query()->create([
            'code' => '010000000',
            'name' => 'Ilocos Region',
            'region_name' => 'Region I',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0100000000',
        ]);

        $this->getJson('/api/psgc/regions')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'code' => '010000000',
                'name' => 'Ilocos Region',
                'regionName' => 'Region I',
                'islandGroupCode' => 'luzon',
                'psgc10DigitCode' => '0100000000',
            ]);
    }

    public function test_provinces_cities_and_barangays_endpoints_return_expected_shapes(): void
    {
        Cache::flush();

        PsgcRegion::query()->create([
            'code' => '020000000',
            'name' => 'Cagayan Valley',
            'region_name' => 'Region II',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0200000000',
        ]);

        PsgcProvince::query()->create([
            'code' => '021500000',
            'name' => 'Cagayan',
            'region_code' => '020000000',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0201500000',
        ]);

        PsgcCity::query()->create([
            'code' => '021511000',
            'name' => 'Tuguegarao City',
            'old_name' => null,
            'is_capital' => true,
            'kind' => 'city',
            'region_code' => '020000000',
            'province_code' => '021500000',
            'district_code' => null,
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0201529000',
        ]);

        PsgcBarangay::query()->create([
            'code' => '021511001',
            'name' => 'Recovered Barangay',
            'old_name' => null,
            'region_code' => '020000000',
            'province_code' => null,
            'city_code' => '021511000',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0215110010',
        ]);

        PsgcCity::query()->create([
            'code' => '021501000',
            'name' => 'Allacapan',
            'old_name' => null,
            'is_capital' => false,
            'kind' => 'municipality',
            'region_code' => '020000000',
            'province_code' => '021500000',
            'district_code' => null,
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0201501000',
        ]);

        PsgcBarangay::query()->create([
            'code' => '021501001',
            'name' => 'Alinunu',
            'old_name' => null,
            'region_code' => '020000000',
            'province_code' => '021500000',
            'city_code' => '021501000',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0201501001',
        ]);

        $this->getJson('/api/psgc/regions/020000000/provinces')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'code' => '021500000',
                'name' => 'Cagayan',
                'regionCode' => '020000000',
            ]);

        $this->getJson('/api/psgc/provinces/021500000/cities')
            ->assertOk()
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'code' => '021511000',
                'name' => 'Tuguegarao City',
                'isCapital' => true,
                'provinceCode' => '021500000',
                'districtCode' => false,
                'regionCode' => '020000000',
            ]);

        $this->getJson('/api/psgc/cities/021511000/barangays')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'code' => '021511001',
                'name' => 'Recovered Barangay',
                'provinceCode' => false,
                'cityCode' => '021511000',
            ]);

        $this->getJson('/api/psgc/cities/021501000/barangays')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'code' => '021501001',
                'name' => 'Alinunu',
                'provinceCode' => '021500000',
                'cityCode' => '021501000',
            ]);
    }

    public function test_preload_endpoint_batches_multiple_lists(): void
    {
        Cache::flush();

        PsgcRegion::query()->create([
            'code' => '030000000',
            'name' => 'Central Luzon',
            'region_name' => 'Region III',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0300000000',
        ]);

        PsgcProvince::query()->create([
            'code' => '031400000',
            'name' => 'Bulacan',
            'region_code' => '030000000',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0301400000',
        ]);

        PsgcCity::query()->create([
            'code' => '031410000',
            'name' => 'City of Malolos',
            'old_name' => '',
            'is_capital' => true,
            'kind' => 'city',
            'region_code' => '030000000',
            'province_code' => '031400000',
            'district_code' => null,
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0301410000',
        ]);

        PsgcBarangay::query()->create([
            'code' => '031410001',
            'name' => 'Test Barangay',
            'old_name' => '',
            'region_code' => '030000000',
            'province_code' => '031400000',
            'city_code' => '031410000',
            'island_group_code' => 'luzon',
            'psgc_10_digit_code' => '0314100010',
        ]);

        $this->getJson('/api/psgc/preload?region=030000000&province=031400000&city=031410000')
            ->assertOk()
            ->assertJsonStructure([
                'regions',
                'provinces',
                'cities',
                'barangays',
            ])
            ->assertJsonPath('provinces.0.code', '031400000')
            ->assertJsonPath('cities.0.code', '031410000')
            ->assertJsonPath('barangays.0.code', '031410001');
    }
}
