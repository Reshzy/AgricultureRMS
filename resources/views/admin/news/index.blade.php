@extends('layouts.admin')

@section('title', 'News Management • Admin')
@section('header', 'News Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">News Management</h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.news.create') }}" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm transition"><i class="fa-solid fa-plus mr-1"></i> Create News</a>
    </div>
</div>

@if (session('status'))
<div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded p-3">{{ session('status') }}</div>
@endif

<div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
    <div class="px-6 py-4 border-b border-emerald-900/10">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="text-emerald-900 font-semibold">All News Articles</div>
            <div class="flex items-center gap-2">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search news..." class="px-3 py-2 rounded-lg border text-sm w-64" />
                    <button type="submit" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm transition">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-emerald-50/50">
                <tr>
                    <th class="px-6 py-3 text-emerald-900 font-medium">Title</th>
                    <th class="px-6 py-3 text-emerald-900 font-medium">Status</th>
                    <th class="px-6 py-3 text-emerald-900 font-medium">Priority</th>
                    <th class="px-6 py-3 text-emerald-900 font-medium">Published</th>
                    <th class="px-6 py-3 text-emerald-900 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-emerald-900/10">
                @forelse ($news as $item)
                <tr class="hover:bg-emerald-50/40 transition">
                    <td class="px-6 py-4">
                        <div class="font-medium text-emerald-900">{{ $item->title }}</div>
                        <div class="text-xs text-emerald-700 mt-1 line-clamp-1">{{ Str::limit(strip_tags($item->content), 80) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs {{ $item->status === 'published' ? 'bg-emerald-100 text-emerald-700' : ($item->status === 'scheduled' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs {{ $item->priority === 'urgent' ? 'bg-red-100 text-red-700' : ($item->priority === 'important' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ ucfirst($item->priority) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-emerald-700">{{ $item->published_at?->format('Y-m-d H:i') ?? '—' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.news.edit', $item) }}" class="text-emerald-600 hover:text-emerald-900 mr-3"><i class="fa-solid fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.news.destroy', $item) }}" class="inline" onsubmit="return confirm('Delete this news?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-900"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No news articles yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($news->hasPages())
    <div class="px-6 py-4 border-t border-emerald-900/10">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection