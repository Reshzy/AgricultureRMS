<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Claim extends Model
{
    use HasFactory;

    public const TYPE_DEATH = 'death';

    public const TYPE_ACCIDENT = 'accident';

    public const TYPE_DESTROYED_CROPS = 'destroyed_crops';

    public const TYPE_LIVESTOCK = 'livestock';

    public const STATUS_SUBMITTED = 'submitted';

    public const STATUS_UNDER_REVIEW = 'under_review';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'enrollment_id',
        'claim_type',
        'contact_email',
        'contact_email_verified_at',
        'status',
        'review_notes',
        'reviewed_by_user_id',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'contact_email_verified_at' => 'datetime',
            'reviewed_at' => 'datetime',
        ];
    }

    public static function claimTypes(): array
    {
        return [
            self::TYPE_DEATH,
            self::TYPE_ACCIDENT,
            self::TYPE_DESTROYED_CROPS,
            self::TYPE_LIVESTOCK,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function typeLabels(): array
    {
        return [
            self::TYPE_DEATH => 'Death Claim',
            self::TYPE_ACCIDENT => 'Accident Claim',
            self::TYPE_DESTROYED_CROPS => 'Destroyed Crops Claim',
            self::TYPE_LIVESTOCK => 'Livestock Claim',
        ];
    }

    public static function labelForType(string $type): string
    {
        return self::typeLabels()[$type] ?? ucfirst(str_replace('_', ' ', $type));
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_SUBMITTED,
            self::STATUS_UNDER_REVIEW,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
        ];
    }

    /**
     * @return array<string, array<string, string>>
     */
    public static function documentRequirements(): array
    {
        return [
            self::TYPE_DEATH => [
                'death_certificate' => 'Death Certificate',
                'beneficiary_valid_id' => 'Valid ID of the Beneficiary',
                'medical_certificate' => 'Medical Certificate',
            ],
            self::TYPE_ACCIDENT => [
                'receipt' => 'Receipt',
                'office_certification' => 'Certification from the Office',
                'medical_certificate' => 'Medical Certificate',
            ],
            self::TYPE_DESTROYED_CROPS => [
                'claim_for_indemnity' => 'Claim for Indemnity',
                'notice_of_loss' => 'Notice of Loss',
                'certification' => 'Certification',
            ],
            self::TYPE_LIVESTOCK => [
                'claim_for_indemnity' => 'Claim for Indemnity',
                'notice_of_loss' => 'Notice of Loss',
                'certification' => 'Certification',
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function requirementsFor(string $claimType): array
    {
        return self::documentRequirements()[$claimType] ?? [];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ClaimDocument::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }
}
