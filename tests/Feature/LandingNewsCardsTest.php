<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class LandingNewsCardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_news_cards_show_category_and_snippet(): void
    {
        $content = str_repeat('Smart irrigation systems help farmers optimize water usage. ', 10);

        $news = News::create([
            'title' => 'Irrigation update',
            'slug' => 'irrigation-update-test',
            'content' => $content,
            'featured_image_path' => null,
            'categories' => ['technology', 'advisory'],
            'tags' => ['smart irrigation'],
            'audience' => 'all_farmers',
            'priority' => 'normal',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $expectedSnippet = Str::limit(strip_tags($news->content), 160);

        $this->get('/')
            ->assertStatus(200)
            ->assertSee($news->title)
            ->assertSee('Technology')
            ->assertSee('Advisory')
            ->assertSee('news-tether-curve')
            ->assertSee($expectedSnippet);
    }
}
