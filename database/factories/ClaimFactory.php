<?php

namespace Database\Factories;

use App\Models\Claim;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Claim>
 */
class ClaimFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_id' => Enrollment::factory(),
            'claim_type' => fake()->randomElement(Claim::claimTypes()),
            'contact_email' => fake()->safeEmail(),
            'contact_email_verified_at' => null,
            'status' => Claim::STATUS_SUBMITTED,
            'review_notes' => null,
            'reviewed_by_user_id' => null,
            'reviewed_at' => null,
        ];
    }
}
