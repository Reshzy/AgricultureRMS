<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_path',
        'rsbsa_reference_number',
        'surname',
        'first_name',
        'middle_name',
        'extension_name',
        'sex',
        'address_house_lot',
        'address_street',
        'address_barangay',
        'address_municipality_city',
        'address_province',
        'address_region',
        'mobile_number',
        'landline_number',
        'date_of_birth',
        'place_of_birth',
        'highest_formal_education',
        'religion',
        'civil_status',
        'name_of_spouse',
        'mothers_maiden_name',
        'household_head',
        'household_head_name',
        'relationship_to_head',
        'household_members_total',
        'household_members_male',
        'household_members_female',
        'is_pwd',
        'is_four_ps_beneficiary',
        'is_indigenous_group_member',
        'indigenous_group_specify',
        'has_government_id',
        'government_id_type',
        'government_id_number',
        'emergency_contact_name',
        'emergency_contact_number',
        'main_livelihood',
        'farming_activities',
        'other_crop_specify',
        'livestock_type_specify',
        'poultry_type_specify',
        'farmworker_kinds_of_work',
        'farmworker_other_work',
        'fishing_activities',
        'fishing_other_activity',
        'agriyouth_involvements',
        'agriyouth_other_involvement',
        'gross_income_farming',
        'gross_income_non_farming',
        'rotation_farmers_p1',
        'rotation_farmers_p2',
        'rotation_farmers_p3',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'household_head' => 'boolean',
        'household_members_total' => 'integer',
        'household_members_male' => 'integer',
        'household_members_female' => 'integer',
        'is_pwd' => 'boolean',
        'is_four_ps_beneficiary' => 'boolean',
        'is_indigenous_group_member' => 'boolean',
        'has_government_id' => 'boolean',
        'farming_activities' => 'array',
        'farmworker_kinds_of_work' => 'array',
        'fishing_activities' => 'array',
        'agriyouth_involvements' => 'array',
    ];

    public function farmParcels(): HasMany
    {
        return $this->hasMany(FarmParcel::class);
    }

    public function parcelHistories(): HasMany
    {
        return $this->hasMany(FarmParcelHistory::class);
    }
}
