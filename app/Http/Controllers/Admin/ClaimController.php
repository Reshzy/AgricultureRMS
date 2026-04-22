<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClaimStatusRequest;
use App\Models\Claim;
use App\Notifications\ClaimStatusNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class ClaimController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('q'));
        $status = trim((string) $request->input('status'));
        $claimType = trim((string) $request->input('claim_type'));
        $perPage = (int) $request->input('per_page', 15);

        if (! in_array($perPage, [10, 15, 25, 50, 100], true)) {
            $perPage = 15;
        }

        $claims = Claim::query()
            ->with(['enrollment', 'reviewedBy'])
            ->when($search !== '', function ($query) use ($search): void {
                $query->whereHas('enrollment', function ($enrollmentQuery) use ($search): void {
                    $enrollmentQuery
                        ->where('rsbsa_reference_number', 'like', '%'.$search.'%')
                        ->orWhere('first_name', 'like', '%'.$search.'%')
                        ->orWhere('middle_name', 'like', '%'.$search.'%')
                        ->orWhere('surname', 'like', '%'.$search.'%');
                });
            })
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($claimType !== '', fn ($query) => $query->where('claim_type', $claimType))
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.claims.index', [
            'claims' => $claims,
            'search' => $search,
            'status' => $status,
            'claimType' => $claimType,
            'perPage' => $perPage,
            'claimTypes' => Claim::claimTypes(),
            'statuses' => Claim::statuses(),
            'claimLabels' => Claim::typeLabels(),
        ]);
    }

    public function show(Claim $claim): View
    {
        $claim->load(['enrollment', 'documents', 'reviewedBy']);

        return view('admin.claims.show', [
            'claim' => $claim,
            'claimLabels' => Claim::typeLabels(),
            'statuses' => Claim::statuses(),
        ]);
    }

    public function update(UpdateClaimStatusRequest $request, Claim $claim): RedirectResponse
    {
        $validated = $request->validated();
        $status = $validated['status'];
        $isFinalStatus = in_array($status, [Claim::STATUS_APPROVED, Claim::STATUS_REJECTED], true);

        $claim->update([
            'status' => $status,
            'review_notes' => $validated['review_notes'] ?? null,
            'reviewed_by_user_id' => $request->user()?->id,
            'reviewed_at' => $isFinalStatus ? now() : null,
        ]);

        if (! empty($claim->contact_email)) {
            Notification::route('mail', $claim->contact_email)
                ->notify(new ClaimStatusNotification($claim->fresh('enrollment')));
        }

        return redirect()
            ->route('admin.claims.show', $claim)
            ->with('status', 'Claim status updated.');
    }
}
