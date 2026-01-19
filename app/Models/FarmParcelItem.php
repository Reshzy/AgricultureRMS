<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmParcelItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_parcel_id','kind','name','size_ha','num_of_head','farm_type','is_organic_practitioner','remarks'
    ];

    protected $casts = [
        'is_organic_practitioner' => 'boolean',
    ];

    public function parcel(): BelongsTo
    {
        return $this->belongsTo(FarmParcel::class, 'farm_parcel_id');
    }
}
