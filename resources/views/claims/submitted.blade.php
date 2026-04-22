<x-guest-layout>
    <div class="mx-auto w-full max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-start gap-3">
                <div class="mt-1 inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-emerald-900">Claim Submitted Successfully</h1>
                    <p class="mt-1 text-sm text-gray-600">Your claim is now queued for admin review.</p>
                </div>
            </div>

            <div class="space-y-3 rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700">
                <p><span class="font-semibold text-gray-900">RSBSA Number:</span> {{ $claim->enrollment?->rsbsa_reference_number ?? 'N/A' }}</p>
                <p><span class="font-semibold text-gray-900">Claim Type:</span> {{ $claimLabels[$claim->claim_type] ?? ucfirst(str_replace('_', ' ', $claim->claim_type)) }}</p>
                <p><span class="font-semibold text-gray-900">Status:</span> {{ ucfirst(str_replace('_', ' ', $claim->status)) }}</p>
                <p><span class="font-semibold text-gray-900">Submitted At:</span> {{ $claim->created_at?->format('Y-m-d h:i A') }}</p>
                <p><span class="font-semibold text-gray-900">Uploaded Files:</span> {{ $claim->documents->count() }}</p>
            </div>

            <div class="mt-6 flex flex-wrap gap-2">
                <a href="{{ route('claims.apply') }}" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Submit Another Claim
                </a>
                <a href="{{ route('home') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Back to Landing Page
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
