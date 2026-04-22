@extends('layouts.admin')

@section('title', 'Claim Details • Admin')
@section('header', 'Claim Details')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-emerald-900">Claim Review</h1>
        <p class="mt-1 text-sm text-emerald-800">Validate submitted documents and update claim status.</p>
    </div>
    <a href="{{ route('admin.claims.index') }}" class="rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Back to Claims</a>
</div>

@if (session('status'))
<div class="mb-4 rounded border border-green-200 bg-green-100 p-3 text-green-700">{{ session('status') }}</div>
@endif

@if ($errors->any())
<div class="mb-4 rounded border border-red-200 bg-red-100 p-3 text-red-700">
    <ul class="list-disc space-y-1 pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="rounded-2xl border border-emerald-900/5 bg-white/90 p-5">
            <h2 class="text-lg font-semibold text-emerald-900">Claim Information</h2>
            <dl class="mt-4 grid grid-cols-1 gap-3 text-sm text-gray-700 sm:grid-cols-2">
                <div>
                    <dt class="font-medium text-gray-900">Farmer</dt>
                    <dd>{{ trim(($claim->enrollment?->first_name ?? '').' '.($claim->enrollment?->middle_name ?? '').' '.($claim->enrollment?->surname ?? '')) }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-900">RSBSA Number</dt>
                    <dd>{{ $claim->enrollment?->rsbsa_reference_number ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-900">Claim Type</dt>
                    <dd>{{ $claimLabels[$claim->claim_type] ?? ucfirst(str_replace('_', ' ', $claim->claim_type)) }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-900">Current Status</dt>
                    <dd>{{ ucfirst(str_replace('_', ' ', $claim->status)) }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-900">Submitted At</dt>
                    <dd>{{ $claim->created_at?->format('Y-m-d h:i A') }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-900">Reviewed By</dt>
                    <dd>{{ $claim->reviewedBy?->name ?? 'Not reviewed yet' }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-2xl border border-emerald-900/5 bg-white/90 p-5">
            <h2 class="text-lg font-semibold text-emerald-900">Uploaded Documents</h2>
            <div class="mt-4 space-y-3">
                @forelse ($claim->documents as $document)
                    <div class="flex flex-wrap items-center justify-between gap-2 rounded-lg border border-gray-200 px-3 py-2 text-sm">
                        <div>
                            <p class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $document->document_key)) }}</p>
                            <p class="text-xs text-gray-600">{{ $document->original_name }} ({{ number_format($document->size / 1024, 2) }} KB)</p>
                        </div>
                        <a href="{{ asset('storage/'.$document->path) }}" target="_blank" class="rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-emerald-700">
                            Open File
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No documents found for this claim.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-emerald-900/5 bg-white/90 p-5">
        <h2 class="text-lg font-semibold text-emerald-900">Update Claim Status</h2>
        <form method="POST" action="{{ route('admin.claims.update', $claim) }}" class="mt-4 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="status" class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ old('status', $claim->status) === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="review_notes" class="mb-1 block text-sm font-medium text-gray-700">Review Notes</label>
                <textarea name="review_notes" id="review_notes" rows="6" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm" placeholder="Optional notes for approval/rejection...">{{ old('review_notes', $claim->review_notes) }}</textarea>
            </div>

            <button type="submit" class="w-full rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                Save Status
            </button>
        </form>
    </div>
</div>
@endsection
