<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PolicyTermsPagesTest extends TestCase
{
    use RefreshDatabase;
    public function test_policy_page_returns_success_and_shows_privacy_policy(): void
    {
        $response = $this->get(route('policy'));

        $response->assertStatus(200);
        $response->assertSee('Privacy Policy', false);
    }

    public function test_terms_page_returns_success_and_shows_terms_of_service(): void
    {
        $response = $this->get(route('terms'));

        $response->assertStatus(200);
        $response->assertSee('Terms of Service', false);
    }

    public function test_landing_page_contains_links_to_policy_and_terms(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee(route('policy'), false);
        $response->assertSee(route('terms'), false);
    }
}
