<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsSearch extends Component
{
    use WithPagination;

    public string $search = '';

    public string $category = '';

    /**
     * @var array<int, string>
     */
    public array $availableCategories = [];

    protected array $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount(): void
    {
        $this->search = request()->string('q')->toString();
        $this->category = request()->string('category')->toString();

        $this->availableCategories = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereNotNull('categories')
            ->get()
            ->pluck('categories')
            ->flatten()
            ->unique()
            ->filter()
            ->sort()
            ->values()
            ->all();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');

        if ($this->search !== '') {
            $search = $this->search;
            $like = '%'.$search.'%';

            $query->where(function ($q) use ($like): void {
                $q->where('title', 'like', $like)
                    ->orWhere('content', 'like', $like)
                    ->orWhere('tags', 'like', $like);
            });
        }

        if ($this->category !== '') {
            $query->whereJsonContains('categories', $this->category);
        }

        $news = $query->paginate(10);

        $hero = null;
        $rest = $news;

        $first = $news->first();

        if ($first !== null && $first->featured_image_path) {
            $hero = $first;
            $rest = $news->slice(1);
        }

        return view('livewire.news-search', [
            'news' => $news,
            'hero' => $hero,
            'rest' => $rest,
        ]);
    }
}
