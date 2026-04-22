<?php

namespace Database\Factories;

use App\Models\Claim;
use App\Models\ClaimDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClaimDocument>
 */
class ClaimDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'claim_id' => Claim::factory(),
            'document_key' => fake()->randomElement([
                'death_certificate',
                'beneficiary_valid_id',
                'medical_certificate',
                'receipt',
                'office_certification',
                'claim_for_indemnity',
                'notice_of_loss',
                'certification',
            ]),
            'original_name' => fake()->word().'.pdf',
            'path' => 'claims/sample.pdf',
            'mime_type' => 'application/pdf',
            'size' => fake()->numberBetween(1000, 500000),
        ];
    }
}
