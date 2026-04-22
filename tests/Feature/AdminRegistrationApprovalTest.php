<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRegistrationApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_creates_pending_admin_request(): void
    {
        $response = $this->post('/register', [
            'name' => 'Pending User',
            'email' => 'pending@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertRedirect(route('pending-approval'));
        $this->assertAuthenticated();

        $user = User::where('email', 'pending@example.com')->first();
        $this->assertNotNull($user);
        $this->assertFalse((bool) $user->is_admin);
        $this->assertFalse((bool) $user->is_main_admin);
        $this->assertSame(User::ADMIN_REQUEST_PENDING, $user->admin_request_status);
    }

    public function test_non_main_admin_cannot_approve_or_reject_requests(): void
    {
        $admin = User::factory()->approvedAdmin()->create();
        $pendingUser = User::factory()->create();

        $approveResponse = $this->actingAs($admin)->patch(route('admin.users.approve', $pendingUser));

        $approveResponse->assertRedirect(route('dashboard'));
        $this->assertFalse($pendingUser->fresh()->is_admin);

        $rejectResponse = $this->actingAs($admin)->delete(route('admin.users.reject', $pendingUser));

        $rejectResponse->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('users', ['id' => $pendingUser->id]);
    }

    public function test_main_admin_can_approve_pending_request(): void
    {
        $mainAdmin = User::factory()->mainAdmin()->create();
        $pendingUser = User::factory()->create();

        $response = $this->actingAs($mainAdmin)->patch(route('admin.users.approve', $pendingUser));

        $response->assertRedirect();
        $pendingUser->refresh();

        $this->assertTrue((bool) $pendingUser->is_admin);
        $this->assertSame(User::ADMIN_REQUEST_APPROVED, $pendingUser->admin_request_status);
        $this->assertNotNull($pendingUser->approved_at);
    }

    public function test_main_admin_reject_deletes_pending_request_account(): void
    {
        $mainAdmin = User::factory()->mainAdmin()->create();
        $pendingUser = User::factory()->create();

        $response = $this->actingAs($mainAdmin)->delete(route('admin.users.reject', $pendingUser));

        $response->assertRedirect();
        $this->assertModelMissing($pendingUser);
    }

    public function test_pending_user_is_redirected_away_from_admin_dashboard(): void
    {
        $pendingUser = User::factory()->create();

        $response = $this->actingAs($pendingUser)->get(route('dashboard'));

        $response->assertRedirect(route('pending-approval'));
    }

    public function test_main_admin_can_disable_and_reenable_an_approved_admin(): void
    {
        $mainAdmin = User::factory()->mainAdmin()->create();
        $approvedAdmin = User::factory()->approvedAdmin()->create();

        $disableResponse = $this->actingAs($mainAdmin)->patch(route('admin.users.disable', $approvedAdmin));

        $disableResponse->assertRedirect();
        $this->assertFalse((bool) $approvedAdmin->fresh()->is_active);

        $enableResponse = $this->actingAs($mainAdmin)->patch(route('admin.users.enable', $approvedAdmin));

        $enableResponse->assertRedirect();
        $this->assertTrue((bool) $approvedAdmin->fresh()->is_active);
    }

    public function test_disabled_admin_cannot_access_dashboard(): void
    {
        $disabledAdmin = User::factory()->approvedAdmin()->disabled()->create();

        $response = $this->actingAs($disabledAdmin)->get(route('dashboard'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error');
    }

    public function test_disabled_admin_cannot_log_in(): void
    {
        $disabledAdmin = User::factory()->approvedAdmin()->disabled()->create([
            'password' => bcrypt('Password123!'),
        ]);

        $response = $this->post('/login', [
            'email' => $disabledAdmin->email,
            'password' => 'Password123!',
        ]);

        $response->assertRedirect();
        $this->assertGuest();
    }
}
