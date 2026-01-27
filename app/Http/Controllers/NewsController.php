<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    /**
     * Publish any scheduled news items that have reached their publish time
     */
    // protected function publishScheduledNews()
    // {
    //     News::where('status', 'scheduled')
    //         ->whereNotNull('published_at')
    //         ->where('published_at', '<=', now())
    //         ->update(['status' => 'published']);
    // }

    public function index(Request $request)
    {
        return view('news.index');
    }

    public function show(string $slug)
    {
        // Auto-publish scheduled news items that are due
        // $this->publishScheduledNews();

        $news = News::where('slug', $slug)
            ->where(function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
            })
            ->firstOrFail();

        return view('news.show', compact('news'));
    }

    public function adminIndex(Request $request)
    {
        $query = News::query()->orderByDesc('created_at');

        if ($search = $request->string('q')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        $news = $query->paginate(10)->withQueryString();

        return view('admin.news.manage', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'audience' => ['required', 'string', Rule::in(['all_farmers', 'farmers', 'farmworker_laborer', 'fisherfolk', 'agri_youth'])],
            'priority' => ['required', 'string', Rule::in(['normal', 'important', 'urgent'])],
            'publish' => ['required', Rule::in(['now', 'schedule', 'draft'])],
            'schedule_date' => ['nullable', 'date'],
            'schedule_time' => ['nullable'],
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('news', 'public');
        }

        $publishedAt = null;
        $status = 'draft';
        if ($validated['publish'] === 'now') {
            $status = 'published';
            $publishedAt = now();
        } elseif ($validated['publish'] === 'schedule') {
            $status = 'scheduled';
            if ($validated['schedule_date']) {
                $time = $validated['schedule_time'] ?? '00:00:00';
                $publishedAt = Carbon::parse($validated['schedule_date'].' '.$time);
            }
        }

        // Merge tags from CSV if provided
        $tags = $validated['tags'] ?? [];
        $tagsCsv = trim((string) $request->input('tags_csv', ''));
        if ($tagsCsv !== '') {
            $fromCsv = array_filter(array_map('trim', explode(',', $tagsCsv)));
            $tags = array_values(array_unique(array_merge($tags, $fromCsv)));
        }

        $news = News::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.Str::random(6),
            'content' => $validated['content'],
            'featured_image_path' => $imagePath,
            'categories' => $validated['categories'] ?? [],
            'tags' => $tags,
            'audience' => $validated['audience'] ?? 'all',
            'priority' => $validated['priority'],
            'status' => $status,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.news.index')->with('status', 'News created successfully');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'audience' => ['required', 'string', Rule::in(['all_farmers', 'farmers', 'farmworker_laborer', 'fisherfolk', 'agri_youth'])],
            'priority' => ['required', 'string', Rule::in(['normal', 'important', 'urgent'])],
            'publish' => ['required', Rule::in(['now', 'schedule', 'draft'])],
            'schedule_date' => ['nullable', 'date'],
            'schedule_time' => ['nullable'],
        ]);

        if ($request->hasFile('featured_image')) {
            $news->featured_image_path = $request->file('featured_image')->store('news', 'public');
        }

        $news->title = $validated['title'];
        $news->content = $validated['content'];
        $news->categories = $validated['categories'] ?? [];
        // Merge tags from CSV and array
        $tags = $validated['tags'] ?? [];
        $tagsCsv = trim((string) $request->input('tags_csv', ''));
        if ($tagsCsv !== '') {
            $fromCsv = array_filter(array_map('trim', explode(',', $tagsCsv)));
            $tags = array_values(array_unique(array_merge($tags, $fromCsv)));
        }
        $news->tags = $tags;
        $news->audience = $validated['audience'];
        $news->priority = $validated['priority'];

        if ($validated['publish'] === 'now') {
            $news->status = 'published';
            $news->published_at = now();
        } elseif ($validated['publish'] === 'schedule') {
            $news->status = 'scheduled';
            if ($validated['schedule_date']) {
                $time = $validated['schedule_time'] ?? '00:00:00';
                $news->published_at = Carbon::parse($validated['schedule_date'].' '.$time);
            }
        } else {
            $news->status = 'draft';
            $news->published_at = null;
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('status', 'News updated successfully');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('status', 'News deleted');
    }
}
