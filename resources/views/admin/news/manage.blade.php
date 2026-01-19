@extends('layouts.admin')

@section('title', 'News Management • Admin')
@section('header', 'News Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-emerald-900">News Management</h1>
</div>

@if (session('status'))
<div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded p-3">{{ session('status') }}</div>
@endif

<div class="bg-white/90 rounded-2xl border border-emerald-900/5 overflow-hidden">
    <!-- Tabs -->
    <div class="px-6 py-4 border-b border-emerald-900/10">
        <nav class="flex -mb-px">
            <button id="viewTab" class="tab-button active py-3 px-6 text-center border-b-2 font-medium text-sm border-emerald-600 text-emerald-600 rounded-t-lg">
                <i class="fa-solid fa-list mr-2"></i>View News
            </button>
            <button id="uploadTab" class="tab-button py-3 px-6 text-center border-b-2 font-medium text-sm border-transparent text-emerald-700 hover:text-emerald-900 hover:border-emerald-300 rounded-t-lg transition">
                <i class="fa-solid fa-plus mr-2"></i>Upload News
            </button>
        </nav>
    </div>

    <!-- View Section -->
    <div id="viewSection" class="p-6">
        <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
            <div class="text-emerald-900 font-semibold">All News Articles</div>
            <div class="flex items-center gap-2">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search news..." class="px-3 py-2 rounded-lg border border-emerald-900/20 text-sm w-64 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" />
                    <button type="submit" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm transition">Search</button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-emerald-50/50">
                    <tr>
                        <th class="px-6 py-3 text-emerald-900 font-medium">Title</th>
                        <th class="px-6 py-3 text-emerald-900 font-medium">Categories</th>
                        <th class="px-6 py-3 text-emerald-900 font-medium">Audience</th>
                        <th class="px-6 py-3 text-emerald-900 font-medium">Published</th>
                        <th class="px-6 py-3 text-emerald-900 font-medium">Status</th>
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
                            @if (!empty($item->categories))
                            <div class="flex flex-wrap gap-1">
                                @foreach ($item->categories as $cat)
                                <span class="px-2 py-1 text-xs rounded-full bg-emerald-100 text-emerald-700">{{ ucfirst($cat) }}</span>
                                @endforeach
                            </div>
                            @else
                            <span class="text-emerald-600">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-emerald-700">{{ ucfirst(str_replace('_', ' ', $item->audience)) }}</td>
                        <td class="px-6 py-4 text-emerald-700">{{ $item->published_at?->format('Y-m-d H:i') ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs {{ $item->status === 'published' ? 'bg-emerald-100 text-emerald-700' : ($item->status === 'scheduled' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
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
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">No news articles yet.</td>
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

    <!-- Upload Section -->
    <div id="uploadSection" class="p-6 hidden">
        <div class="text-emerald-900 font-semibold mb-6">Create New Article</div>
        <form id="newsForm" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">News Title</label>
                <input name="title" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">News Content</label>
                <textarea name="content" rows="6" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Categories</label>
                <div class="flex flex-wrap gap-3 mt-1 text-sm">
                    @foreach (['weather','market','training','government','technology'] as $cat)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="categories[]" value="{{ $cat }}" class="rounded text-emerald-600 border-emerald-900/20 focus:ring-emerald-600">
                        <span class="ml-2 capitalize text-emerald-900">{{ $cat }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Target Audience</label>
                <select name="audience" class="w-full px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    <option value="all_farmers">All Farmers</option>
                    <option value="farmers">Farmers</option>
                    <option value="farmworker_laborer">Farmworker/Laborer</option>
                    <option value="fisherfolk">Fisherfolk</option>
                    <option value="agri_youth">Agri Youth</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Priority</label>
                <div class="flex gap-6 mt-2">
                    @foreach (['normal'=>'Normal','important'=>'Important','urgent'=>'Urgent'] as $val=>$label)
                    <label class="inline-flex items-center">
                        <input type="radio" name="priority" value="{{ $val }}" class="text-emerald-600 border-emerald-900/20 focus:ring-emerald-600" {{ $val==='normal' ? 'checked' : '' }}>
                        <span class="ml-2 text-emerald-900">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Featured Image</label>
                <div id="dropzone" class="border-2 border-dashed border-emerald-900/20 rounded-lg p-8 text-center cursor-pointer hover:border-emerald-600 transition">
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <i class="fas fa-cloud-upload-alt text-4xl text-emerald-600"></i>
                        <p class="text-emerald-700">Drag & drop your image here, or click to browse</p>
                        <p class="text-xs text-emerald-600">Supports JPG, PNG up to 5MB</p>
                    </div>
                    <input type="file" id="fileInput" name="featured_image" class="hidden" accept="image/*">
                </div>
                <div id="previewContainer" class="mt-4 hidden">
                    <div class="flex items-center justify-between bg-emerald-50 p-3 rounded-lg border border-emerald-900/10">
                        <div class="flex items-center space-x-3">
                            <img id="previewImage" src="#" alt="Preview" class="w-12 h-12 object-cover rounded">
                            <div>
                                <p id="fileName" class="font-medium text-emerald-900"></p>
                                <p id="fileSize" class="text-xs text-emerald-700"></p>
                            </div>
                        </div>
                        <button type="button" id="removeImage" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-900 mb-2">Tags (Press Enter, comma, or paste multiple)</label>
                <div class="flex flex-wrap items-center border border-emerald-900/20 rounded-lg px-3 py-2 focus-within:border-emerald-600 focus-within:ring-1 focus-within:ring-emerald-600">
                    <div id="tagContainer" class="flex flex-wrap gap-2 mr-2"></div>
                    <input type="text" id="tagInput" placeholder="Add tags or paste comma-separated list..." class="flex-grow outline-none text-emerald-900">
                    <input type="hidden" name="tags_csv" id="tagsCsv">
                </div>
                <p class="text-xs text-emerald-600 mt-1">Add relevant tags to help farmers find this news easily. You can paste multiple tags separated by commas or new lines.</p>
            </div>
            <div class="border-t border-emerald-900/10 pt-4">
                <label class="block text-sm font-medium text-emerald-900 mb-2">Publish Options</label>
                <div class="flex items-center space-x-4 mt-1">
                    <label class="inline-flex items-center">
                        <input type="radio" name="publish" value="now" class="text-emerald-600 border-emerald-900/20 focus:ring-emerald-600" checked>
                        <span class="ml-2 text-emerald-900">Publish Now</span>
                    </label>
                    <!--<label class="inline-flex items-center">-->
                    <!--    <input type="radio" name="publish" value="schedule" class="text-emerald-600 border-emerald-900/20 focus:ring-emerald-600">-->
                    <!--    <span class="ml-2 text-emerald-900">Schedule for Later</span>-->
                    <!--</label>-->
                    <label class="inline-flex items-center">
                        <input type="radio" name="publish" value="draft" class="text-emerald-600 border-emerald-900/20 focus:ring-emerald-600">
                        <span class="ml-2 text-emerald-900">Save as Draft</span>
                    </label>
                </div>
                <div id="scheduleContainer" class="mt-3 hidden">
                    <div class="flex space-x-2">
                        <input type="date" name="schedule_date" class="px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" />
                        <input type="time" name="schedule_time" class="px-3 py-2 border border-emerald-900/20 rounded-lg focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 pt-4 border-t border-emerald-900/10">
                <button type="button" onclick="document.getElementById('newsForm').reset()" class="px-4 py-2 border border-emerald-900/20 text-emerald-700 rounded-lg hover:bg-emerald-50 transition">Clear</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                    <i class="fas fa-paper-plane mr-2"></i> Publish News
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Tab switching
    const viewTab = document.getElementById('viewTab');
    const uploadTab = document.getElementById('uploadTab');
    const viewSection = document.getElementById('viewSection');
    const uploadSection = document.getElementById('uploadSection');

    viewTab?.addEventListener('click', () => {
        viewTab.classList.add('border-emerald-600', 'text-emerald-600');
        viewTab.classList.remove('border-transparent', 'text-emerald-700');
        uploadTab.classList.remove('border-emerald-600', 'text-emerald-600');
        uploadTab.classList.add('border-transparent', 'text-emerald-700');
        viewSection.classList.remove('hidden');
        uploadSection.classList.add('hidden');
    });

    uploadTab?.addEventListener('click', () => {
        uploadTab.classList.add('border-emerald-600', 'text-emerald-600');
        uploadTab.classList.remove('border-transparent', 'text-emerald-700');
        viewTab.classList.remove('border-emerald-600', 'text-emerald-600');
        viewTab.classList.add('border-transparent', 'text-emerald-700');
        uploadSection.classList.remove('hidden');
        viewSection.classList.add('hidden');
    });

    // Dropzone
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeImage = document.getElementById('removeImage');
    const tagInput = document.getElementById('tagInput');
    const tagContainer = document.getElementById('tagContainer');
    const tagsCsv = document.getElementById('tagsCsv');
    const publishRadios = document.querySelectorAll('input[name="publish"]');
    const scheduleContainer = document.getElementById('scheduleContainer');

    dropzone?.addEventListener('click', () => fileInput.click());
    fileInput?.addEventListener('change', (e) => {
        if (e.target.files.length) {
            const file = e.target.files[0];
            if (file.size > 5 * 1024 * 1024) {
                alert('File size exceeds 5MB limit');
                return;
            }
            const reader = new FileReader();
            reader.onload = (event) => {
                previewImage.src = event.target.result;
                fileName.textContent = file.name;
                fileSize.textContent = `${(file.size / 1024).toFixed(1)} KB`;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    ;
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => dropzone?.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
    }));;
    ['dragenter', 'dragover'].forEach(evt => dropzone?.addEventListener(evt, () => dropzone.classList.add('ring-2', 'ring-emerald-500')));;
    ['dragleave', 'drop'].forEach(evt => dropzone?.addEventListener(evt, () => dropzone.classList.remove('ring-2', 'ring-emerald-500')));
    dropzone?.addEventListener('drop', (e) => {
        fileInput.files = e.dataTransfer.files;
        fileInput.dispatchEvent(new Event('change'));
    });
    removeImage?.addEventListener('click', () => {
        previewContainer.classList.add('hidden');
        fileInput.value = '';
    });

    // Tags chips -> hidden CSV
    const currentTags = [];
    const syncTagsCsv = () => {
        tagsCsv.value = currentTags.join(',');
    };

    const addTag = (tagText) => {
        if (tagText && !currentTags.includes(tagText)) {
            currentTags.push(tagText);
            const chip = document.createElement('div');
            chip.className = 'bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm flex items-center';
            chip.innerHTML = `${tagText} <button type="button" class="ml-2 text-emerald-600 hover:text-emerald-800">&times;</button>`;
            chip.querySelector('button').addEventListener('click', () => {
                chip.remove();
                const idx = currentTags.indexOf(tagText);
                if (idx > -1) currentTags.splice(idx, 1);
                syncTagsCsv();
            });
            tagContainer.appendChild(chip);
            syncTagsCsv();
        }
    };

    tagInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && tagInput.value.trim() !== '') {
            e.preventDefault();
            const tagText = tagInput.value.trim();
            addTag(tagText);
            tagInput.value = '';
        }
    });

    tagInput?.addEventListener('input', (e) => {
        const value = e.target.value;
        if (value.includes(',')) {
            // Split by commas and process all parts
            const parts = value.split(',').map(part => part.trim()).filter(Boolean);

            // Add all complete tags (all but the last part)
            for (let i = 0; i < parts.length - 1; i++) {
                if (parts[i]) {
                    addTag(parts[i]);
                }
            }

            // Keep the last part (if any) in the input for continued typing
            const lastPart = parts[parts.length - 1] || '';
            tagInput.value = lastPart;
        }
    });

    // Handle paste events specifically to process multi-line content
    tagInput?.addEventListener('paste', (e) => {
        // Small delay to let the paste content appear in the input
        setTimeout(() => {
            const value = tagInput.value;
            if (value.includes(',') || value.includes('\n')) {
                // Split by both commas and newlines, clean up whitespace
                const parts = value.split(/[,\n]+/)
                    .map(part => part.trim())
                    .filter(Boolean);

                // Add all tags
                parts.forEach(part => {
                    if (part) {
                        addTag(part);
                    }
                });

                // Clear the input after processing
                tagInput.value = '';
            }
        }, 10);
    });

    // Publish schedule toggle
    publishRadios.forEach(r => r.addEventListener('change', () => {
        const val = document.querySelector('input[name="publish"]:checked').value;
        if (val === 'schedule') scheduleContainer.classList.remove('hidden');
        else scheduleContainer.classList.add('hidden');
    }));
</script>
@endpush