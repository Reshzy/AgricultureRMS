<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClaimRequest;
use App\Models\Claim;
use App\Models\Enrollment;
use App\Notifications\ClaimStatusNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class ClaimApplicationController extends Controller
{
    public function create(): View
    {
        return view('claims.apply', [
            'claimRequirements' => Claim::documentRequirements(),
            'claimLabels' => Claim::typeLabels(),
        ]);
    }

    public function searchRsbsa(Request $request): JsonResponse
    {
        $query = trim((string) $request->input('q', ''));
        if (mb_strlen($query) < 3) {
            return response()->json([
                'data' => [],
                'message' => 'Enter at least 3 characters to search.',
            ]);
        }

        $enrollments = Enrollment::query()
            ->select([
                'id',
                'rsbsa_reference_number',
                'first_name',
                'middle_name',
                'surname',
                'address_barangay',
                'address_municipality_city',
            ])
            ->whereNotNull('rsbsa_reference_number')
            ->where('rsbsa_reference_number', 'like', '%'.$query.'%')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $enrollments->map(function (Enrollment $enrollment): array {
                return [
                    'id' => $enrollment->id,
                    'rsbsa_reference_number' => $enrollment->rsbsa_reference_number,
                    'full_name' => trim(implode(' ', array_filter([
                        $enrollment->first_name,
                        $enrollment->middle_name,
                        $enrollment->surname,
                    ]))),
                    'barangay' => $enrollment->address_barangay,
                    'municipality' => $enrollment->address_municipality_city,
                ];
            }),
            'message' => $enrollments->isEmpty() ? 'No registered farmer found for this RSBSA number.' : null,
        ]);
    }

    public function store(StoreClaimRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $claim = DB::transaction(function () use ($validated, $request): Claim {
            $claim = Claim::create([
                'enrollment_id' => (int) $validated['enrollment_id'],
                'claim_type' => $validated['claim_type'],
                'contact_email' => $validated['contact_email'],
                'status' => Claim::STATUS_SUBMITTED,
            ]);

            foreach (array_keys(Claim::requirementsFor($claim->claim_type)) as $documentKey) {
                $files = $request->file('documents.'.$documentKey, []);
                foreach ($files as $file) {
                    $path = $file->store('claims/'.$claim->id, 'public');
                    $claim->documents()->create([
                        'document_key' => $documentKey,
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'mime_type' => $file->getClientMimeType() ?? 'application/octet-stream',
                        'size' => $file->getSize(),
                    ]);
                }
            }

            return $claim;
        });

        Notification::route('mail', $claim->contact_email)
            ->notify(new ClaimStatusNotification($claim->load('enrollment')));

        return redirect()
            ->route('claims.submitted', $claim)
            ->with('status', 'Claim submitted successfully.');
    }

    public function submitted(Claim $claim): View
    {
        $claim->load(['enrollment', 'documents']);

        return view('claims.submitted', [
            'claim' => $claim,
            'claimLabels' => Claim::typeLabels(),
        ]);
    }
}
