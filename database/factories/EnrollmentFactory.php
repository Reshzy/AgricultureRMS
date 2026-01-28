<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'surname' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'extension_name' => null,
            'sex' => fake()->randomElement(['male', 'female']),
            'address_barangay' => fake()->optional()->city(),
            'address_municipality_city' => fake()->optional()->city(),
            'address_province' => fake()->optional()->state(),
            'address_region' => fake()->optional()->state(),
            'mobile_number' => fake()->optional()->phoneNumber(),
            'landline_number' => fake()->optional()->phoneNumber(),
            'date_of_birth' => fake()->optional()->date(),
            'place_of_birth' => fake()->optional()->city(),
            'highest_formal_education' => fake()->optional()->randomElement(['Pre-school', 'Elementary', 'High school (non-K-12)', 'Junior High school (K-12)', 'Senior High school (K-12)', 'College', 'Vocational', 'Post graduate', 'None']),
            'religion' => fake()->optional()->randomElement(['Christianity', 'Islam', 'Others']),
            'civil_status' => fake()->optional()->randomElement(['single', 'married', 'widowed', 'separated']),
            'name_of_spouse' => fake()->optional()->name(),
            'mothers_maiden_name' => fake()->optional()->name(),
            'household_head' => false,
            'household_head_name' => null,
            'relationship_to_head' => null,
            'household_members_total' => 0,
            'household_members_male' => 0,
            'household_members_female' => 0,
            'is_pwd' => false,
            'is_four_ps_beneficiary' => false,
            'is_indigenous_group_member' => false,
            'indigenous_group_specify' => null,
            'has_government_id' => false,
            'government_id_type' => null,
            'government_id_number' => null,
            'emergency_contact_name' => fake()->optional()->name(),
            'emergency_contact_number' => fake()->optional()->phoneNumber(),
            'main_livelihood' => fake()->randomElement(['farmer', 'farmworker', 'fisherfolk', 'agri_youth']),
            'farming_activities' => null,
            'other_crop_specify' => null,
            'livestock_type_specify' => null,
            'poultry_type_specify' => null,
            'farmworker_kinds_of_work' => null,
            'farmworker_other_work' => null,
            'fishing_activities' => null,
            'fishing_other_activity' => null,
            'agriyouth_involvements' => null,
            'agriyouth_other_involvement' => null,
            'gross_income_farming' => fake()->optional()->randomFloat(2, 0, 1000000),
            'gross_income_non_farming' => fake()->optional()->randomFloat(2, 0, 1000000),
            'rotation_farmers_p1' => null,
            'rotation_farmers_p2' => null,
            'rotation_farmers_p3' => null,
            'status' => fake()->randomElement(['draft', 'submitted']),
            'has_insurance_registered' => false,
            'rsbsa_reference_number' => fake()->optional()->numerify('RSBSA-#######'),
        ];
    }
}
