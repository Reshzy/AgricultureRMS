<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::query()->ordered()->get();
        $usageCounts = $this->categoryUsageCounts();

        return view('admin.news.categories.index', compact('categories', 'usageCounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:news_categories,name'],
        ]);

        $slug = $this->makeUniqueSlug($validated['name']);
        $maxSortOrder = (int) NewsCategory::query()->max('sort_order');

        NewsCategory::query()->create([
            'name' => $validated['name'],
            'slug' => $slug,
            'is_active' => true,
            'sort_order' => $maxSortOrder + 1,
        ]);

        return redirect()->route('admin.news.categories.index')
            ->with('status', 'Category created successfully.');
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('news_categories', 'name')->ignore($newsCategory->id),
            ],
        ]);

        $oldSlug = $newsCategory->slug;
        $newSlug = $this->makeUniqueSlug($validated['name'], $newsCategory->id);

        DB::transaction(function () use ($newsCategory, $validated, $newSlug, $oldSlug): void {
            $newsCategory->update([
                'name' => $validated['name'],
                'slug' => $newSlug,
            ]);

            if ($newSlug !== $oldSlug) {
                $this->syncNewsCategorySlug($oldSlug, $newSlug);
            }
        });

        return redirect()->route('admin.news.categories.index')
            ->with('status', 'Category updated successfully.');
    }

    public function archive(NewsCategory $newsCategory)
    {
        $newsCategory->update(['is_active' => false]);

        return redirect()->route('admin.news.categories.index')
            ->with('status', 'Category archived.');
    }

    public function reactivate(NewsCategory $newsCategory)
    {
        $newsCategory->update(['is_active' => true]);

        return redirect()->route('admin.news.categories.index')
            ->with('status', 'Category reactivated.');
    }

    /**
     * @return array<string, int>
     */
    protected function categoryUsageCounts(): array
    {
        return News::query()
            ->whereNotNull('categories')
            ->pluck('categories')
            ->flatten()
            ->filter()
            ->countBy()
            ->map(fn ($count): int => (int) $count)
            ->all();
    }

    protected function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        if ($base === '') {
            $base = 'category';
        }

        $slug = $base;
        $counter = 2;

        while (
            NewsCategory::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    protected function syncNewsCategorySlug(string $oldSlug, string $newSlug): void
    {
        News::query()
            ->whereJsonContains('categories', $oldSlug)
            ->chunkById(100, function ($newsItems) use ($oldSlug, $newSlug): void {
                foreach ($newsItems as $newsItem) {
                    $categories = collect($newsItem->categories ?? [])
                        ->map(fn ($category) => $category === $oldSlug ? $newSlug : $category)
                        ->unique()
                        ->values()
                        ->all();

                    $newsItem->update(['categories' => $categories]);
                }
            });
    }
}
