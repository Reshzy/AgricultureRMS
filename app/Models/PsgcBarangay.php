<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsgcBarangay extends Model
{
    protected $fillable = [
        'code',
        'name',
        'old_name',
        'region_code',
        'province_code',
        'city_code',
        'island_group_code',
        'psgc_10_digit_code',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(PsgcRegion::class, 'region_code', 'code');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(PsgcProvince::class, 'province_code', 'code');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(PsgcCity::class, 'city_code', 'code');
    }
}
