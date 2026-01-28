<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentIndexFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollments_index_page_loads_without_filters(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        Enrollment::factory()->create([
            'surname' => 'Doe',
            'first_name' => 'John',
            'sex' => 'male',
            'main_livelihood' => 'farmer',
            'status' => 'submitted',
        ]);

        $response = $this->get('/admin/enrollments');

        $response->assertStatus(200);
        $response->assertSee('Doe');
    }

    public function test_filter_by_insurance_registered(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $withInsurance = Enrollment::factory()->create([
            'has_insurance_registered' => true,
            'surname' => 'WithInsurance',
        ]);

        $withoutInsurance = Enrollment::factory()->create([
            'has_insurance_registered' => false,
            'surname' => 'WithoutInsurance',
        ]);

        $response = $this->get('/admin/enrollments?insurance=1');

        $response->assertStatus(200);
        $response->assertSee('WithInsurance');
        $response->assertDontSee('WithoutInsurance');
    }

    public function test_filter_by_sex(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $male = Enrollment::factory()->create([
            'sex' => 'male',
            'surname' => 'MaleEnrollment',
        ]);

        $female = Enrollment::factory()->create([
            'sex' => 'female',
            'surname' => 'FemaleEnrollment',
        ]);

        $response = $this->get('/admin/enrollments?sex=female');

        $response->assertStatus(200);
        $response->assertSee('FemaleEnrollment');
        $response->assertDontSee('MaleEnrollment');
    }

    public function test_filter_by_mobile_number(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $matching = Enrollment::factory()->create([
            'mobile_number' => '09123456789',
            'surname' => 'MatchingMobile',
        ]);

        $nonMatching = Enrollment::factory()->create([
            'mobile_number' => '09987654321',
            'surname' => 'NonMatchingMobile',
        ]);

        $response = $this->get('/admin/enrollments?mobile=123');

        $response->assertStatus(200);
        $response->assertSee('MatchingMobile');
        $response->assertDontSee('NonMatchingMobile');
    }

    public function test_filter_by_landline_number(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $matching = Enrollment::factory()->create([
            'landline_number' => '123-4567',
            'surname' => 'MatchingLandline',
        ]);

        $nonMatching = Enrollment::factory()->create([
            'landline_number' => '987-6543',
            'surname' => 'NonMatchingLandline',
        ]);

        $response = $this->get('/admin/enrollments?landline=123');

        $response->assertStatus(200);
        $response->assertSee('MatchingLandline');
        $response->assertDontSee('NonMatchingLandline');
    }

    public function test_filter_by_highest_formal_education(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $college = Enrollment::factory()->create([
            'highest_formal_education' => 'College',
            'surname' => 'CollegeGrad',
        ]);

        $elementary = Enrollment::factory()->create([
            'highest_formal_education' => 'Elementary',
            'surname' => 'ElementaryGrad',
        ]);

        $response = $this->get('/admin/enrollments?education=College');

        $response->assertStatus(200);
        $response->assertSee('CollegeGrad');
        $response->assertDontSee('ElementaryGrad');
    }

    public function test_filter_by_religion(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $christian = Enrollment::factory()->create([
            'religion' => 'Christianity',
            'surname' => 'Christian',
        ]);

        $islam = Enrollment::factory()->create([
            'religion' => 'Islam',
            'surname' => 'Muslim',
        ]);

        $response = $this->get('/admin/enrollments?religion=Christ');

        $response->assertStatus(200);
        $response->assertSee('Christian');
        $response->assertDontSee('Muslim');
    }

    public function test_filter_by_civil_status(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $married = Enrollment::factory()->create([
            'civil_status' => 'married',
            'surname' => 'MarriedPerson',
        ]);

        $single = Enrollment::factory()->create([
            'civil_status' => 'single',
            'surname' => 'SinglePerson',
        ]);

        $response = $this->get('/admin/enrollments?civil_status=married');

        $response->assertStatus(200);
        $response->assertSee('MarriedPerson');
        $response->assertDontSee('SinglePerson');
    }

    public function test_filter_by_household_head(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $head = Enrollment::factory()->create([
            'household_head' => true,
            'surname' => 'HouseholdHead',
        ]);

        $notHead = Enrollment::factory()->create([
            'household_head' => false,
            'surname' => 'NotHouseholdHead',
        ]);

        $response = $this->get('/admin/enrollments?household_head=1');

        $response->assertStatus(200);
        $response->assertSee('HouseholdHead');
        $response->assertDontSee('NotHouseholdHead');
    }

    public function test_filter_by_pwd(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $pwd = Enrollment::factory()->create([
            'is_pwd' => true,
            'surname' => 'PWDEnrollment',
        ]);

        $notPwd = Enrollment::factory()->create([
            'is_pwd' => false,
            'surname' => 'NotPWDEnrollment',
        ]);

        $response = $this->get('/admin/enrollments?pwd=1');

        $response->assertStatus(200);
        $response->assertSee('PWDEnrollment');
        $response->assertDontSee('NotPWDEnrollment');
    }

    public function test_filter_by_four_ps_beneficiary(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $beneficiary = Enrollment::factory()->create([
            'is_four_ps_beneficiary' => true,
            'surname' => 'FourPsBeneficiary',
        ]);

        $notBeneficiary = Enrollment::factory()->create([
            'is_four_ps_beneficiary' => false,
            'surname' => 'NotFourPsBeneficiary',
        ]);

        $response = $this->get('/admin/enrollments?four_ps=1');

        $response->assertStatus(200);
        $response->assertSee('FourPsBeneficiary');
        $response->assertDontSee('NotFourPsBeneficiary');
    }

    public function test_filter_by_indigenous_group_member(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $indigenous = Enrollment::factory()->create([
            'is_indigenous_group_member' => true,
            'surname' => 'IndigenousMember',
        ]);

        $notIndigenous = Enrollment::factory()->create([
            'is_indigenous_group_member' => false,
            'surname' => 'NotIndigenousMember',
        ]);

        $response = $this->get('/admin/enrollments?indigenous=1');

        $response->assertStatus(200);
        $response->assertSee('IndigenousMember');
        $response->assertDontSee('NotIndigenousMember');
    }

    public function test_filter_by_government_id(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $withId = Enrollment::factory()->create([
            'has_government_id' => true,
            'surname' => 'WithGovernmentId',
        ]);

        $withoutId = Enrollment::factory()->create([
            'has_government_id' => false,
            'surname' => 'WithoutGovernmentId',
        ]);

        $response = $this->get('/admin/enrollments?government_id=1');

        $response->assertStatus(200);
        $response->assertSee('WithGovernmentId');
        $response->assertDontSee('WithoutGovernmentId');
    }

    public function test_multiple_filters_work_together(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $matching = Enrollment::factory()->create([
            'sex' => 'female',
            'is_pwd' => true,
            'mobile_number' => '09123456789',
            'surname' => 'MatchingAll',
        ]);

        $partialMatch = Enrollment::factory()->create([
            'sex' => 'female',
            'is_pwd' => false,
            'mobile_number' => '09123456789',
            'surname' => 'PartialMatch',
        ]);

        $nonMatching = Enrollment::factory()->create([
            'sex' => 'male',
            'is_pwd' => true,
            'mobile_number' => '09987654321',
            'surname' => 'NonMatching',
        ]);

        $response = $this->get('/admin/enrollments?sex=female&pwd=1&mobile=123');

        $response->assertStatus(200);
        $response->assertSee('MatchingAll');
        $response->assertDontSee('PartialMatch');
        $response->assertDontSee('NonMatching');
    }
}
