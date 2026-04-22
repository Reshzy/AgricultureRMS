<?php

namespace Tests\Feature;

use App\Models\Claim;
use App\Models\Enrollment;
use App\Models\User;
use App\Notifications\ClaimStatusNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClaimApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_farmer_can_search_rsbsa_records(): void
    {
        $enrollment = Enrollment::factory()->create([
            'first_name' => 'Juan',
            'surname' => 'Dela Cruz',
            'rsbsa_reference_number' => 'RSBSA-123456',
        ]);

        $response = $this->getJson(route('claims.search', ['q' => '123']));

        $response->assertOk();
        $response->assertJsonPath('data.0.id', $enrollment->id);
        $response->assertJsonPath('data.0.rsbsa_reference_number', 'RSBSA-123456');
    }

    public function test_farmer_gets_not_registered_message_when_rsbsa_not_found(): void
    {
        $response = $this->getJson(route('claims.search', ['q' => 'NOPE-001']));

        $response->assertOk();
        $response->assertJsonCount(0, 'data');
        $response->assertJsonPath('message', 'No registered farmer found for this RSBSA number.');
    }

    public function test_farmer_can_submit_a_claim_with_required_documents(): void
    {
        Storage::fake('public');
        Notification::fake();
        $enrollment = Enrollment::factory()->create([
            'rsbsa_reference_number' => 'RSBSA-7001',
        ]);

        $response = $this->post(route('claims.store'), [
            'enrollment_id' => $enrollment->id,
            'claim_type' => Claim::TYPE_DEATH,
            'contact_email' => 'farmer@laravel.com',
            'documents' => [
                'death_certificate' => [
                    UploadedFile::fake()->create('death_certificate.pdf', 120, 'application/pdf'),
                ],
                'beneficiary_valid_id' => [
                    UploadedFile::fake()->image('valid_id.jpg'),
                ],
                'medical_certificate' => [
                    UploadedFile::fake()->create('medical_certificate.pdf', 140, 'application/pdf'),
                ],
            ],
        ]);

        $claim = Claim::query()->first();

        $response->assertRedirect(route('claims.submitted', $claim));
        $this->assertNotNull($claim);
        $this->assertSame($enrollment->id, $claim->enrollment_id);
        $this->assertSame(Claim::TYPE_DEATH, $claim->claim_type);
        $this->assertSame('farmer@laravel.com', $claim->contact_email);
        $this->assertSame(Claim::STATUS_SUBMITTED, $claim->status);
        $this->assertDatabaseCount('claim_documents', 3);
        Notification::assertSentOnDemand(
            ClaimStatusNotification::class,
            function (ClaimStatusNotification $notification, array $channels, object $notifiable): bool {
                return $notifiable->routeNotificationFor('mail') === 'farmer@laravel.com'
                    && $notification->claim->status === Claim::STATUS_SUBMITTED;
            }
        );

        $claim->documents->each(function ($document): void {
            $this->assertTrue(Storage::disk('public')->exists($document->path));
        });
    }

    public function test_claim_submission_fails_when_required_documents_are_missing(): void
    {
        $enrollment = Enrollment::factory()->create([
            'rsbsa_reference_number' => 'RSBSA-7002',
        ]);

        $response = $this->from(route('claims.apply'))->post(route('claims.store'), [
            'enrollment_id' => $enrollment->id,
            'claim_type' => Claim::TYPE_ACCIDENT,
            'contact_email' => 'farmer@laravel.com',
            'documents' => [
                'receipt' => [
                    UploadedFile::fake()->create('receipt.pdf', 90, 'application/pdf'),
                ],
            ],
        ]);

        $response->assertRedirect(route('claims.apply'));
        $response->assertSessionHasErrors([
            'documents.office_certification',
            'documents.medical_certificate',
        ]);
        $this->assertDatabaseCount('claims', 0);
    }

    public function test_claim_submission_fails_when_contact_email_is_missing(): void
    {
        $enrollment = Enrollment::factory()->create([
            'rsbsa_reference_number' => 'RSBSA-7010',
        ]);

        $response = $this->from(route('claims.apply'))->post(route('claims.store'), [
            'enrollment_id' => $enrollment->id,
            'claim_type' => Claim::TYPE_DEATH,
            'documents' => [
                'death_certificate' => [
                    UploadedFile::fake()->create('death_certificate.pdf', 120, 'application/pdf'),
                ],
                'beneficiary_valid_id' => [
                    UploadedFile::fake()->image('valid_id.jpg'),
                ],
                'medical_certificate' => [
                    UploadedFile::fake()->create('medical_certificate.pdf', 140, 'application/pdf'),
                ],
            ],
        ]);

        $response->assertRedirect(route('claims.apply'));
        $response->assertSessionHasErrors('contact_email');
    }

    public function test_admin_can_view_claims_list_and_update_claim_status(): void
    {
        Notification::fake();
        $admin = User::factory()->approvedAdmin()->create();
        $claim = Claim::factory()->create([
            'contact_email' => 'review@laravel.com',
        ]);

        $indexResponse = $this->actingAs($admin)->get(route('admin.claims.index'));
        $indexResponse->assertOk();
        $indexResponse->assertSee('Claims Management');

        $updateResponse = $this->actingAs($admin)->patch(route('admin.claims.update', $claim), [
            'status' => Claim::STATUS_APPROVED,
            'review_notes' => 'Complete documents provided.',
        ]);

        $updateResponse->assertRedirect(route('admin.claims.show', $claim));
        $this->assertDatabaseHas('claims', [
            'id' => $claim->id,
            'status' => Claim::STATUS_APPROVED,
            'reviewed_by_user_id' => $admin->id,
            'review_notes' => 'Complete documents provided.',
        ]);
        Notification::assertSentOnDemand(
            ClaimStatusNotification::class,
            function (ClaimStatusNotification $notification, array $channels, object $notifiable): bool {
                return $notifiable->routeNotificationFor('mail') === 'review@laravel.com'
                    && $notification->claim->status === Claim::STATUS_APPROVED;
            }
        );
    }

    public function test_admin_status_updates_send_notifications_for_each_review_status(): void
    {
        Notification::fake();
        $admin = User::factory()->approvedAdmin()->create();

        $statusTargets = [
            Claim::STATUS_UNDER_REVIEW,
            Claim::STATUS_APPROVED,
            Claim::STATUS_REJECTED,
        ];

        foreach ($statusTargets as $index => $targetStatus) {
            $email = "claim-status-{$index}@laravel.com";
            $claim = Claim::factory()->create([
                'contact_email' => $email,
            ]);

            $response = $this->actingAs($admin)->patch(route('admin.claims.update', $claim), [
                'status' => $targetStatus,
                'review_notes' => 'Status changed by admin.',
            ]);

            $response->assertRedirect(route('admin.claims.show', $claim));

            Notification::assertSentOnDemand(
                ClaimStatusNotification::class,
                function (ClaimStatusNotification $notification, array $channels, object $notifiable) use ($email, $targetStatus): bool {
                    return $notifiable->routeNotificationFor('mail') === $email
                        && $notification->claim->status === $targetStatus;
                }
            );
        }
    }

    public function test_non_admin_user_cannot_access_admin_claims_routes(): void
    {
        $user = User::factory()->create();
        $claim = Claim::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.claims.index'));
        $response->assertRedirect(route('pending-approval'));

        $updateResponse = $this->actingAs($user)->patch(route('admin.claims.update', $claim), [
            'status' => Claim::STATUS_REJECTED,
        ]);
        $updateResponse->assertRedirect(route('pending-approval'));
    }
}
