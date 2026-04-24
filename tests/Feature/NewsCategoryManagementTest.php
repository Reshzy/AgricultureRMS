<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsCategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_rename_archive_and_reactivate_categories(): void
    {
        $admin = User::factory()->approvedAdmin()->create();

        $this->actingAs($admin)
            ->post(route('admin.news.categories.store'), [
                'name' => 'Pest Advisory',
            ])
            ->assertRedirect(route('admin.news.categories.index'));

        $category = NewsCategory::query()->where('name', 'Pest Advisory')->firstOrFail();
        $this->assertSame('pest-advisory', $category->slug);
        $this->assertTrue($category->is_active);

        $this->actingAs($admin)
            ->put(route('admin.news.categories.update', $category), [
                'name' => 'Pests and Disease',
            ])
            ->assertRedirect(route('admin.news.categories.index'));

        $category->refresh();
        $this->assertSame('Pests and Disease', $category->name);
        $this->assertSame('pests-and-disease', $category->slug);

        $this->actingAs($admin)
            ->patch(route('admin.news.categories.archive', $category))
            ->assertRedirect(route('admin.news.categories.index'));

        $this->assertFalse($category->fresh()->is_active);

        $this->actingAs($admin)
            ->patch(route('admin.news.categories.reactivate', $category))
            ->assertRedirect(route('admin.news.categories.index'));

        $this->assertTrue($category->fresh()->is_active);
    }

    public function test_renaming_category_syncs_existing_news_category_slug(): void
    {
        $admin = User::factory()->approvedAdmin()->create();
        $category = NewsCategory::query()->where('slug', 'market')->firstOrFail();

        $news = News::query()->create([
            'title' => 'Pricing update',
            'slug' => 'pricing-update-test',
            'content' => 'Farmgate prices changed this week.',
            'featured_image_path' => null,
            'categories' => ['market'],
            'tags' => ['price'],
            'audience' => 'all_farmers',
            'priority' => 'normal',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->actingAs($admin)
            ->put(route('admin.news.categories.update', $category), [
                'name' => 'Market Watch',
            ])
            ->assertRedirect(route('admin.news.categories.index'));

        $this->assertSame(['market-watch'], $news->fresh()->categories);
    }

    public function test_non_admin_user_cannot_access_category_management_routes(): void
    {
        $user = User::factory()->create();
        $category = NewsCategory::query()->where('slug', 'weather')->firstOrFail();

        $this->actingAs($user)
            ->get(route('admin.news.categories.index'))
            ->assertRedirect(route('pending-approval'));

        $this->actingAs($user)
            ->post(route('admin.news.categories.store'), ['name' => 'Custom'])
            ->assertRedirect(route('pending-approval'));

        $this->actingAs($user)
            ->put(route('admin.news.categories.update', $category), ['name' => 'Updated'])
            ->assertRedirect(route('pending-approval'));
    }

    public function test_news_create_rejects_inactive_or_unknown_categories(): void
    {
        $admin = User::factory()->approvedAdmin()->create();
        $activeCategory = NewsCategory::query()->where('slug', 'weather')->firstOrFail();
        NewsCategory::query()->create([
            'name' => 'Legacy',
            'slug' => 'legacy',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $payload = [
            'title' => 'Validation check',
            'content' => 'Testing category validation.',
            'audience' => 'all_farmers',
            'priority' => 'normal',
            'publish' => 'draft',
            'schedule_date' => null,
            'schedule_time' => null,
            'tags' => [],
        ];

        $this->actingAs($admin)
            ->from(route('admin.news.create'))
            ->post(route('admin.news.store'), array_merge($payload, [
                'categories' => ['legacy'],
            ]))
            ->assertRedirect(route('admin.news.create'))
            ->assertSessionHasErrors('categories.0');

        $this->actingAs($admin)
            ->from(route('admin.news.create'))
            ->post(route('admin.news.store'), array_merge($payload, [
                'categories' => ['unknown-category'],
            ]))
            ->assertRedirect(route('admin.news.create'))
            ->assertSessionHasErrors('categories.0');

        $this->actingAs($admin)
            ->post(route('admin.news.store'), array_merge($payload, [
                'categories' => [$activeCategory->slug],
            ]))
            ->assertRedirect(route('admin.news.index'));
    }
}
