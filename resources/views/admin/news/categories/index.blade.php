@extends('layouts.admin')

@section('title', 'News Categories • Admin')
@section('header', 'News Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">News Categories</h1>
    <a href="{{ route('admin.news.index') }}" class="px-3 py-2 border border-emerald-900/20 text-emerald-700 rounded-lg hover:bg-emerald-50 transition">
        <i class="fa-solid fa-arrow-left mr-1"></i> Back to News
    </a>
</div>

@if (session('status'))
<div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded p-3">{{ session('status') }}</div>
@endif

@if($errors->any())
<div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
    <div class="text-red-800 font-medium mb-2">Please fix the following errors:</div>
    <ul class="text-red-700 text-sm space-y-1">
        @foreach($errors->all() as $error)
        <li>• {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
    <div class="px-6 py-4 border-b border-emerald-900/10">
        <div class="text-emerald-900 font-semibold">Add Category</div>
        <p class="text-sm text-emerald-700 mt-1">Only active categories can be selected when creating or editing news.</p>
    </div>
    <div class="p-6 border-b border-emerald-900/10">
        <form method="POST" action="{{ route('admin.news.categories.store') }}" class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-3">
            @csrf
            <input
                name="name"
                value="{{ old('name') }}"
                placeholder="e.g. Pest Advisory"
                class="px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                required
            />
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                <i class="fa-solid fa-plus mr-2"></i> Add Category
            </button>
        </form>
    </div>

    <div class="p-6">
        <div class="text-emerald-900 font-semibold mb-4">Manage Categories</div>
        <div class="space-y-3">
            @forelse($categories as $category)
            <div class="p-4 rounded-xl border border-emerald-900/10 bg-emerald-50/30">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <form method="POST" action="{{ route('admin.news.categories.update', $category) }}" class="flex-1 grid grid-cols-1 md:grid-cols-[1fr_auto] gap-2">
                        @csrf
                        @method('PUT')
                        <input
                            name="name"
                            value="{{ $category->name }}"
                            class="px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                            required
                        />
                        <button type="submit" class="px-3 py-2 border border-emerald-900/20 text-emerald-700 rounded-lg hover:bg-emerald-100 transition">
                            Rename
                        </button>
                    </form>

                    <div class="flex items-center gap-2 text-sm">
                        <span class="px-2 py-1 rounded-full {{ $category->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $category->is_active ? 'Active' : 'Archived' }}
                        </span>
                        <span class="text-emerald-700">Used in {{ $usageCounts[$category->slug] ?? 0 }} news</span>
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($category->is_active)
                        <form method="POST" action="{{ route('admin.news.categories.archive', $category) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-2 text-sm border border-amber-300 text-amber-700 rounded-lg hover:bg-amber-50 transition">
                                Archive
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.news.categories.reactivate', $category) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-2 text-sm border border-emerald-300 text-emerald-700 rounded-lg hover:bg-emerald-50 transition">
                                Reactivate
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="text-sm text-emerald-700">No categories found yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
