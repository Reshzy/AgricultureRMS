<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsgcCity extends Model
{
    protected $fillable = [
        'code',
        'name',
        'old_name',
        'is_capital',
        'kind',
        'region_code',
        'province_code',
        'district_code',
        'island_group_code',
        'psgc_10_digit_code',
    ];

    protected function casts(): array
    {
        return [
            'is_capital' => 'boolean',
        ];
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(PsgcRegion::class, 'region_code', 'code');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(PsgcProvince::class, 'province_code', 'code');
    }

    public function barangays(): HasMany
    {
        return $this->hasMany(PsgcBarangay::class, 'city_code', 'code');
    }
}
