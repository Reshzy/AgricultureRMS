<?php

namespace Tests\Feature;

use App\Livewire\NewsSearch;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_index_page_renders_livewire_component(): void
    {
        $this->get('/news')
            ->assertStatus(200)
            ->assertSeeLivewire(NewsSearch::class);
    }

    public function test_search_filters_news_by_title_content_and_tags(): void
    {
        $matching = News::create([
            'title' => 'Irrigation update',
            'slug' => 'irrigation-update-test',
            'content' => 'Smart irrigation systems help farmers.',
            'featured_image_path' => null,
            'categories' => ['technology'],
            'tags' => ['smart irrigation'],
            'audience' => 'all_farmers',
            'priority' => 'normal',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $nonMatching = News::create([
            'title' => 'Unrelated topic',
            'slug' => 'unrelated-topic-test',
            'content' => 'Something else entirely.',
            'featured_image_path' => null,
            'categories' => ['other'],
            'tags' => ['other-tag'],
            'audience' => 'all_farmers',
            'priority' => 'normal',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->get('/news?q=irrigation')
            ->assertStatus(200)
            ->assertSee($matching->title)
            ->assertDontSee($nonMatching->title);
    }
}

