<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FarmParcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'barangay','municipality','total_farm_area_ha',
        'ownership_document_no','within_ancestral_domain','is_agrarian_reform_beneficiary','ownership_type','land_owner_name','ownership_other_specify',
        'crop_commodity','livestock_poultry_type','size_ha','num_of_head','farm_type','is_organic_practitioner','remarks',
    ];

    protected $casts = [
        'within_ancestral_domain' => 'boolean',
        'is_agrarian_reform_beneficiary' => 'boolean',
        'is_organic_practitioner' => 'boolean',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(FarmParcelItem::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(FarmParcelHistory::class, 'farm_parcel_id');
    }
}
