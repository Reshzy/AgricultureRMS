@extends('layouts.admin')

@section('title', 'Claims • Admin')
@section('header', 'Claims')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">Claims Management</h1>
    <p class="mt-1 text-sm text-emerald-800">Review and process claim applications submitted by farmers.</p>
</div>

@if (session('status'))
<div class="mb-4 rounded border border-green-200 bg-green-100 p-3 text-green-700">{{ session('status') }}</div>
@endif

<div class="overflow-hidden rounded-2xl border border-emerald-900/5 bg-white/90">
    <div class="border-b border-emerald-900/10 px-6 py-4">
        <form method="GET" class="grid grid-cols-1 gap-2 md:grid-cols-5">
            <input type="text" name="q" value="{{ $search }}" placeholder="Search RSBSA or name..." class="rounded-lg border px-3 py-2 text-sm md:col-span-2">

            <select name="claim_type" class="rounded-lg border px-3 py-2 text-sm">
                <option value="">All claim types</option>
                @foreach ($claimTypes as $type)
                    <option value="{{ $type }}" {{ $claimType === $type ? 'selected' : '' }}>
                        {{ $claimLabels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="rounded-lg border px-3 py-2 text-sm">
                <option value="">All statuses</option>
                @foreach ($statuses as $statusOption)
                    <option value="{{ $statusOption }}" {{ $status === $statusOption ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $statusOption)) }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <select name="per_page" class="w-full rounded-lg border px-3 py-2 text-sm">
                    @foreach([10,15,25,50,100] as $n)
                        <option value="{{ $n }}" {{ $perPage === $n ? 'selected' : '' }}>{{ $n }} / page</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">Apply</button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-emerald-50/60">
                <tr>
                    <th class="px-6 py-3 font-medium text-emerald-900">Farmer</th>
                    <th class="px-6 py-3 font-medium text-emerald-900">Claim Type</th>
                    <th class="px-6 py-3 font-medium text-emerald-900">Status</th>
                    <th class="px-6 py-3 font-medium text-emerald-900">Submitted</th>
                    <th class="px-6 py-3 text-right font-medium text-emerald-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-emerald-900/10">
                @forelse ($claims as $claim)
                <tr class="hover:bg-emerald-50/30">
                    <td class="px-6 py-4">
                        <div class="font-medium text-emerald-900">
                            {{ trim(($claim->enrollment?->first_name ?? '').' '.($claim->enrollment?->middle_name ?? '').' '.($claim->enrollment?->surname ?? '')) }}
                        </div>
                        <div class="text-xs text-emerald-700">{{ $claim->enrollment?->rsbsa_reference_number ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 text-emerald-800">{{ $claimLabels[$claim->claim_type] ?? ucfirst(str_replace('_', ' ', $claim->claim_type)) }}</td>
                    <td class="px-6 py-4">
                        <span class="rounded-full px-2 py-1 text-xs {{
                            $claim->status === 'approved' ? 'bg-emerald-100 text-emerald-700' :
                            ($claim->status === 'rejected' ? 'bg-red-100 text-red-700' :
                            ($claim->status === 'under_review' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-700'))
                        }}">
                            {{ ucfirst(str_replace('_', ' ', $claim->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-emerald-700">{{ $claim->created_at?->format('Y-m-d h:i A') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.claims.show', $claim) }}" class="text-emerald-600 hover:text-emerald-900">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No claims found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($claims->hasPages())
    <div class="border-t border-emerald-900/10 px-6 py-4">
        {{ $claims->links() }}
    </div>
    @endif
</div>
@endsection
