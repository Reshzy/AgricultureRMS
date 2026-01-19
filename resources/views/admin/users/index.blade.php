@extends('layouts.admin')

@section('title', 'Users • Admin')
@section('header', 'Users')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">User Management</h1>
</div>

@if (session('status'))
<div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded p-3">{{ session('status') }}</div>
@endif

@if (session('error'))
<div class="mb-4 text-red-700 bg-red-100 border border-red-200 rounded p-3">{{ session('error') }}</div>
@endif

<div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
    <div class="px-6 py-4 border-b border-emerald-900/10">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="text-emerald-900 font-semibold">All Users</div>
            <div class="flex items-center gap-2">
                <label class="text-xs text-emerald-700">Per page</label>
                <select id="perPage" class="px-2 py-1 rounded border text-sm">
                    @foreach([10,15,25,50,100] as $n)
                    <option value="{{ $n }}" {{ ($perPage ?? 15)===$n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3 grid grid-cols-1 md:grid-cols-4 gap-2">
            <input id="filterSearch" type="text" value="{{ $search ?? '' }}" placeholder="Search name or email..." class="px-3 py-2 rounded-lg border text-sm md:col-span-2" />
            <select id="filterAdmin" class="px-3 py-2 rounded-lg border text-sm">
                <option value="">All users</option>
                <option value="yes" {{ ($adminFilter ?? '')==='yes' ? 'selected':'' }}>Admins only</option>
                <option value="no" {{ ($adminFilter ?? '')==='no' ? 'selected':'' }}>Non-admins only</option>
            </select>
            <button id="resetFilters" class="px-3 py-2 rounded-lg border text-sm">Reset</button>
        </div>
    </div>
    <div id="tableWrap">
        @include('admin.users.partials.table', ['users' => $users])
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrap = document.getElementById('tableWrap');
        const searchI = document.getElementById('filterSearch');
        const adminI = document.getElementById('filterAdmin');
        const perPageI = document.getElementById('perPage');
        const resetBtn = document.getElementById('resetFilters');

        const debounce = (fn, ms = 300) => {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), ms);
            };
        };

        function buildParams(page) {
            const p = new URLSearchParams();
            if (searchI.value.trim()) p.set('q', searchI.value.trim());
            if (adminI.value) p.set('admin', adminI.value);
            p.set('per_page', perPageI.value || '15');
            if (page) p.set('page', page);
            return p.toString();
        }

        async function loadTableWithParams(params) {
            const url = `{{ route('admin.users.index') }}?${params}`;
            const res = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const html = await res.text();
            wrap.innerHTML = html;
        }

        const refresh = debounce(() => loadTableWithParams(buildParams()), 300);

        searchI.addEventListener('input', refresh);
        adminI.addEventListener('change', refresh);
        perPageI.addEventListener('change', () => loadTableWithParams(buildParams(1)));
        resetBtn.addEventListener('click', () => {
            searchI.value = '';
            adminI.value = '';
            loadTableWithParams(buildParams(1));
        });

        // Intercept pagination inside table wrapper
        wrap.addEventListener('click', (e) => {
            const a = e.target.closest('a');
            if (!a) return;
            const url = new URL(a.getAttribute('href'), window.location.origin);
            if (url.searchParams.has('page')) {
                e.preventDefault();
                const page = url.searchParams.get('page');
                loadTableWithParams(buildParams(page));
            }
        });
    });
</script>
@endpush

