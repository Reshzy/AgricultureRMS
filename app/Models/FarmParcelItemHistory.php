<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmParcelItemHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_parcel_item_id',
        'farm_parcel_history_id',
        'kind', 'name', 'size_ha', 'num_of_head', 'farm_type', 'is_organic_practitioner', 'remarks',
        'changed_by_user_id', 'changed_at',
    ];

    protected $casts = [
        'is_organic_practitioner' => 'boolean',
        'changed_at' => 'datetime',
    ];

    public function parcelHistory(): BelongsTo
    {
        return $this->belongsTo(FarmParcelHistory::class, 'farm_parcel_history_id');
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}
