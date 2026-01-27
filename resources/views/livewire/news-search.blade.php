<section class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
        <div class="hidden md:block">
            <p class="text-sm text-emerald-800/70">
                Browse the latest advisories and updates. Use the search to filter by title, content, or tags.
            </p>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search news or tags..."
                class="w-full md:w-80 px-4 py-2.5 rounded-xl border border-emerald-900/10 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
            >

            <select
                wire:model.live="category"
                class="px-4 py-2.5 rounded-xl border border-emerald-900/10 focus:ring-emerald-500 focus:border-emerald-500 bg-white text-emerald-900"
            >
                <option value="">All Categories</option>
                @foreach($availableCategories as $cat)
                    <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div wire:loading.class="opacity-50" wire:target="search,category,page">
        @if($hero)
            <a href="{{ route('news.show', $hero->slug) }}" class="block feature-card bg-white overflow-hidden mb-8">
                <div class="grid md:grid-cols-2">
                    <div class="relative">
                        <img
                            class="w-full h-full object-cover"
                            src="{{ Storage::disk('public')->url($hero->featured_image_path) }}"
                            alt="{{ $hero->title }}"
                        >
                    </div>
                    <div class="p-6 lg:p-8 flex flex-col justify-center">
                        <div class="text-sm text-emerald-700">
                            {{ $hero->published_at?->format('M d, Y') }}
                        </div>
                        <h2 class="mt-2 text-2xl md:text-3xl font-bold text-emerald-900">
                            {{ $hero->title }}
                        </h2>

                        @if (!empty($hero->categories))
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach ($hero->categories as $category)
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200"
                                    >
                                        {{ ucfirst($category) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <p class="mt-3 text-emerald-800/80">
                            {{ Str::limit(strip_tags($hero->content), 220) }}
                        </p>

                        @if (!empty($hero->tags))
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach (array_slice($hero->tags, 0, 3) as $tag)
                                    <button
                                        type="button"
                                        wire:click="$set('search', '{{ $tag }}')"
                                        class="px-2 py-1 rounded-full text-xs bg-emerald-50 text-emerald-700 border border-emerald-900/10 hover:bg-emerald-100"
                                    >
                                        #{{ $tag }}
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-5 inline-flex items-center gap-2 text-emerald-700">
                            Read article
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($rest as $item)
                <a href="{{ route('news.show', $item->slug) }}" class="feature-card bg-white group">
                    @if ($item->featured_image_path)
                        <img
                            class="w-full h-44 object-cover"
                            src="{{ Storage::disk('public')->url($item->featured_image_path) }}"
                            alt="{{ $item->title }}"
                        >
                    @endif

                    <div class="p-6">
                        <div class="text-xs text-emerald-700">
                            {{ $item->published_at?->format('M d, Y') }}
                        </div>

                        <h3 class="mt-2 text-lg font-semibold text-emerald-900 group-hover:underline">
                            {{ $item->title }}
                        </h3>

                        @if (!empty($item->categories))
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach ($item->categories as $category)
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200"
                                    >
                                        {{ ucfirst($category) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <p class="mt-2 text-sm text-emerald-800/80">
                            {{ Str::limit(strip_tags($item->content), 160) }}
                        </p>

                        @if (!empty($item->tags))
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach (array_slice($item->tags, 0, 3) as $tag)
                                    <button
                                        type="button"
                                        wire:click="$set('search', '{{ $tag }}')"
                                        class="px-2 py-1 rounded-full text-xs bg-emerald-50 text-emerald-700 border border-emerald-900/10 hover:bg-emerald-100"
                                    >
                                        #{{ $tag }}
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 text-center text-emerald-800/70">
                    No news available.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $news->links() }}
        </div>
    </div>

    <div
        wire:loading.flex
        wire:target="search,category,page"
        class="fixed inset-0 bg-black/10 backdrop-blur-sm items-center justify-center z-30"
    >
        <div class="px-4 py-2 rounded-xl bg-white shadow text-emerald-800 text-sm flex items-center gap-2">
            <span class="w-3 h-3 rounded-full border-2 border-emerald-500 border-t-transparent animate-spin"></span>
            Updating results...
        </div>
    </div>
</section>

