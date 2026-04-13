<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentFormTabsTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollment_create_page_renders_tabbed_sections(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $response = $this->get(route('admin.enrollments.create'));

        $response->assertOk();
        $response->assertSee('data-tab-trigger="personal"', false);
        $response->assertSee('data-tab-trigger="farm"', false);
        $response->assertSee('data-tab-trigger="parcels"', false);
        $response->assertSee('id="tab-personal-panel"', false);
        $response->assertSee('id="tab-farm-panel"', false);
        $response->assertSee('id="tab-parcels-panel"', false);
    }

    public function test_enrollment_edit_page_renders_tabbed_sections(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $enrollment = Enrollment::factory()->create();
        $this->actingAs($admin);

        $response = $this->get(route('admin.enrollments.edit', $enrollment));

        $response->assertOk();
        $response->assertSee('data-tab-trigger="personal"', false);
        $response->assertSee('data-tab-trigger="farm"', false);
        $response->assertSee('data-tab-trigger="parcels"', false);
        $response->assertSee('id="tab-personal-panel"', false);
        $response->assertSee('id="tab-farm-panel"', false);
        $response->assertSee('id="tab-parcels-panel"', false);
    }
}
