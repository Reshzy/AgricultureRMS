@extends('layouts.admin')

@section('title', 'Create News • Admin')
@section('header', 'Create News')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">Create News Article</h1>
    <a href="{{ route('admin.news.index') }}" class="px-3 py-2 border border-emerald-900/20 text-emerald-700 rounded-lg hover:bg-emerald-50 transition">
        <i class="fa-solid fa-arrow-left mr-1"></i> Back to News
    </a>
</div>

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
        <div class="text-emerald-900 font-semibold">Article Details</div>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Title</label>
                <input name="title" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required value="{{ old('title') }}" />
            </div>

            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Content</label>
                <textarea name="content" rows="8" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required>{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Featured Image (max 5MB)</label>
                <input type="file" name="featured_image" accept="image/*" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" />
            </div>

            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Categories (select any)</label>
                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach (['weather','market','training','government','technology'] as $cat)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="categories[]" value="{{ $cat }}" class="rounded text-emerald-600 border-emerald-900/20 focus:ring-emerald-600" {{ in_array($cat, old('categories', [])) ? 'checked' : '' }}>
                        <span class="ml-2 capitalize text-emerald-900">{{ $cat }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Tags (comma separated)</label>
                <input name="tags_csv" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" placeholder="e.g. irrigation, subsidy" value="{{ old('tags_csv') }}" />
                <p class="text-xs text-emerald-600 mt-1">We'll split into tags automatically</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-emerald-900 mb-2">Audience</label>
                    <select name="audience" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        @foreach (['all_farmers'=>'All farmers','farmers'=>'Farmers','farmworker_laborer'=>'Farmworker/Laborer','fisherfolk'=>'Fisherfolk','agri_youth'=>'Agri Youth'] as $val=>$label)
                        <option value="{{ $val }}" {{ old('audience') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-900 mb-2">Priority</label>
                    <select name="priority" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        @foreach (['normal','important','urgent'] as $p)
                        <option value="{{ $p }}" {{ old('priority') === $p ? 'selected' : '' }} class="capitalize">{{ ucfirst($p) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-900 mb-2">Publish</label>
                    <select name="publish" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <option value="now" {{ old('publish') === 'now' ? 'selected' : '' }}>Publish Now</option>
                        <!--<option value="schedule" {{ old('publish') === 'schedule' ? 'selected' : '' }}>Schedule</option>-->
                        <option value="draft" {{ old('publish') === 'draft' ? 'selected' : '' }}>Save as Draft</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-emerald-900 mb-2">Schedule Date</label>
                    <input type="date" name="schedule_date" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" value="{{ old('schedule_date') }}" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-900 mb-2">Schedule Time</label>
                    <input type="time" name="schedule_time" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" value="{{ old('schedule_time') }}" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-emerald-900/10">
                <a href="{{ route('admin.news.index') }}" class="px-4 py-2 border border-emerald-900/20 text-emerald-700 rounded-lg hover:bg-emerald-50 transition">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                    <i class="fa-solid fa-save mr-2"></i> Save Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            // Remove any existing hidden tag inputs to prevent duplicates
            const existingTagInputs = form.querySelectorAll('input[name="tags[]"]');
            existingTagInputs.forEach(input => input.remove());

            const tagsCsv = form.querySelector('[name="tags_csv"]').value || '';
            if (tagsCsv) {
                tagsCsv.split(',').map(t => t.trim()).filter(Boolean).forEach(tag => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'tags[]';
                    hidden.value = tag;
                    form.appendChild(hidden);
                });
            }
        });
    });
</script>
@endpush