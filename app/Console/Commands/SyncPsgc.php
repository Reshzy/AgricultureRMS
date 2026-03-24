<?php

namespace App\Console\Commands;

use App\Models\PsgcBarangay;
use App\Models\PsgcCity;
use App\Models\PsgcProvince;
use App\Models\PsgcRegion;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SyncPsgc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'psgc:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync PSGC data into local database tables';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Syncing PSGC data…');

        $client = Http::timeout(60)->retry(3, 250);
        if (in_array(config('app.env'), ['local', 'testing'])) {
            $client = $client->withoutVerifying();
        }

        try {
            $regions = $client->get('https://psgc.gitlab.io/api/regions/')->throw()->json();
            $provinces = $client->get('https://psgc.gitlab.io/api/provinces/')->throw()->json();
            $cities = $client->get('https://psgc.gitlab.io/api/cities/')->throw()->json();
            $municipalities = $client->get('https://psgc.gitlab.io/api/municipalities/')->throw()->json();
            $barangays = $client->get('https://psgc.gitlab.io/api/barangays/')->throw()->json();
        } catch (\Throwable $e) {
            $this->error('Failed to fetch PSGC data from upstream.');

            return self::FAILURE;
        }

        if (! is_array($regions) || ! is_array($provinces) || ! is_array($cities) || ! is_array($municipalities) || ! is_array($barangays)) {
            $this->error('Upstream PSGC API returned unexpected data.');

            return self::FAILURE;
        }

        DB::disableQueryLog();

        DB::transaction(function () use ($regions, $provinces, $cities, $municipalities, $barangays): void {
            $regionRows = array_map(function (array $r): array {
                return [
                    'code' => (string) ($r['code'] ?? ''),
                    'name' => (string) ($r['name'] ?? ''),
                    'region_name' => ($r['regionName'] ?? null) ?: null,
                    'island_group_code' => ($r['islandGroupCode'] ?? null) ?: null,
                    'psgc_10_digit_code' => ($r['psgc10DigitCode'] ?? null) ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $regions);

            PsgcRegion::query()->upsert($regionRows, ['code'], ['name', 'region_name', 'island_group_code', 'psgc_10_digit_code', 'updated_at']);

            $provinceRows = array_map(function (array $p): array {
                return [
                    'code' => (string) ($p['code'] ?? ''),
                    'name' => (string) ($p['name'] ?? ''),
                    'region_code' => (string) ($p['regionCode'] ?? ''),
                    'island_group_code' => ($p['islandGroupCode'] ?? null) ?: null,
                    'psgc_10_digit_code' => ($p['psgc10DigitCode'] ?? null) ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $provinces);

            PsgcProvince::query()->upsert($provinceRows, ['code'], ['name', 'region_code', 'island_group_code', 'psgc_10_digit_code', 'updated_at']);

            $mapCityLike = function (array $c, string $kind): array {
                $districtCode = $c['districtCode'] ?? null;
                if ($districtCode === false || $districtCode === '') {
                    $districtCode = null;
                }

                $provinceCode = $c['provinceCode'] ?? null;
                if ($provinceCode === false || $provinceCode === '') {
                    $provinceCode = null;
                }

                return [
                    'code' => (string) ($c['code'] ?? ''),
                    'name' => (string) ($c['name'] ?? ''),
                    'old_name' => ($c['oldName'] ?? null) ?: null,
                    'is_capital' => (bool) ($c['isCapital'] ?? false),
                    'kind' => $kind,
                    'region_code' => (string) ($c['regionCode'] ?? ''),
                    'province_code' => $provinceCode,
                    'district_code' => $districtCode,
                    'island_group_code' => ($c['islandGroupCode'] ?? null) ?: null,
                    'psgc_10_digit_code' => ($c['psgc10DigitCode'] ?? null) ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            };

            $cityRows = array_map(fn (array $c): array => $mapCityLike($c, 'city'), $cities);
            $municipalityRows = array_map(fn (array $m): array => $mapCityLike($m, 'municipality'), $municipalities);

            PsgcCity::query()->upsert(
                array_merge($cityRows, $municipalityRows),
                ['code'],
                ['name', 'old_name', 'is_capital', 'kind', 'region_code', 'province_code', 'district_code', 'island_group_code', 'psgc_10_digit_code', 'updated_at']
            );

            $barangayRows = array_map(function (array $b): array {
                $provinceCode = $b['provinceCode'] ?? null;
                if ($provinceCode === false || $provinceCode === '') {
                    $provinceCode = null;
                }

                $cityCode = $b['cityCode'] ?? null;
                if ($cityCode === false || $cityCode === '') {
                    $cityCode = null;
                }

                $municipalityCode = $b['municipalityCode'] ?? null;
                if ($municipalityCode === false || $municipalityCode === '') {
                    $municipalityCode = null;
                }

                return [
                    'code' => (string) ($b['code'] ?? ''),
                    'name' => (string) ($b['name'] ?? ''),
                    'old_name' => ($b['oldName'] ?? null) ?: null,
                    'region_code' => (string) ($b['regionCode'] ?? ''),
                    'province_code' => $provinceCode,
                    'city_code' => (string) ($cityCode ?? $municipalityCode ?? ''),
                    'island_group_code' => ($b['islandGroupCode'] ?? null) ?: null,
                    'psgc_10_digit_code' => ($b['psgc10DigitCode'] ?? null) ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $barangays);

            foreach (array_chunk($barangayRows, 1000) as $chunk) {
                PsgcBarangay::query()->upsert(
                    $chunk,
                    ['code'],
                    ['name', 'old_name', 'region_code', 'province_code', 'city_code', 'island_group_code', 'psgc_10_digit_code', 'updated_at']
                );
            }
        });

        $this->info('PSGC sync complete.');

        return self::SUCCESS;
    }
}
