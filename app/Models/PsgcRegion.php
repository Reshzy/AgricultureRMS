<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsgcRegion extends Model
{
    protected $fillable = [
        'code',
        'name',
        'region_name',
        'island_group_code',
        'psgc_10_digit_code',
    ];

    public function provinces(): HasMany
    {
        return $this->hasMany(PsgcProvince::class, 'region_code', 'code');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(PsgcCity::class, 'region_code', 'code');
    }

    public function barangays(): HasMany
    {
        return $this->hasMany(PsgcBarangay::class, 'region_code', 'code');
    }
}
