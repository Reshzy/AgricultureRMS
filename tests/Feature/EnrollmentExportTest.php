<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_export_enrollment_as_excel(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $enrollment = Enrollment::factory()->create([
            'surname' => 'Doe',
            'first_name' => 'John',
            'sex' => 'male',
            'main_livelihood' => 'farmer',
            'status' => 'submitted',
        ]);

        $response = $this->get(route('admin.enrollments.excel', $enrollment));

        $response->assertStatus(200);
        $this->assertStringContainsString(
            'spreadsheetml.sheet',
            $response->headers->get('content-type', '')
        );
        $response->assertHeader('content-disposition');
        $this->assertStringContainsString('attachment', $response->headers->get('content-disposition'));
        $this->assertStringContainsString('.xlsx', $response->headers->get('content-disposition'));
    }

    public function test_guest_cannot_export_enrollment(): void
    {
        $enrollment = Enrollment::factory()->create([
            'surname' => 'Doe',
            'first_name' => 'John',
            'sex' => 'male',
            'main_livelihood' => 'farmer',
            'status' => 'submitted',
        ]);

        $response = $this->get(route('admin.enrollments.excel', $enrollment));

        $response->assertRedirect();
    }
}
