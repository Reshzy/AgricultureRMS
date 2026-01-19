<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FarmParcelHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_parcel_id',
        'enrollment_id',
        'barangay', 'municipality', 'total_farm_area_ha',
        'ownership_document_no', 'within_ancestral_domain', 'is_agrarian_reform_beneficiary', 'ownership_type', 'land_owner_name', 'ownership_other_specify',
        'crop_commodity', 'livestock_poultry_type', 'size_ha', 'num_of_head', 'farm_type', 'is_organic_practitioner', 'remarks',
        'changed_by_user_id', 'changed_at', 'change_summary',
    ];

    protected $casts = [
        'within_ancestral_domain' => 'boolean',
        'is_agrarian_reform_beneficiary' => 'boolean',
        'is_organic_practitioner' => 'boolean',
        'changed_at' => 'datetime',
        'change_summary' => 'array',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }

    public function itemHistories(): HasMany
    {
        return $this->hasMany(FarmParcelItemHistory::class);
    }
}
