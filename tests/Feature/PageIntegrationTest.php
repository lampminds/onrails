<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user for the foreign key constraints
        User::factory()->create(['id' => 1]);
    }

    public function test_page_resource_works_with_lampminds_customization()
    {
        // Create a test page
        $page = Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => 'This is test content',
            'active' => true,
        ]);

        $this->assertDatabaseHas('pages', [
            'title' => 'Test Page',
            'slug' => 'test-page',
            'active' => true,
        ]);

        // Test that the page can be retrieved
        $retrievedPage = Page::find($page->id);
        $this->assertEquals('Test Page', $retrievedPage->title);
        $this->assertTrue($retrievedPage->active);
    }

    public function test_page_slug_auto_generation()
    {
        // Create page without slug
        $page = Page::create([
            'title' => 'Auto Generated Slug',
            'content' => 'Test content',
            'active' => true,
        ]);

        $this->assertEquals('auto-generated-slug', $page->slug);
    }

    public function test_page_find_by_slug()
    {
        // Create a test page
        Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => 'Test content',
            'active' => true,
        ]);

        // Test findBySlug method
        $page = Page::findBySlug('test-page');
        $this->assertNotNull($page);
        $this->assertEquals('Test Page', $page->title);

        // Test with inactive page
        Page::create([
            'title' => 'Inactive Page',
            'slug' => 'inactive-page',
            'content' => 'Test content',
            'active' => false,
        ]);

        $inactivePage = Page::findBySlug('inactive-page');
        $this->assertNull($inactivePage);
    }

    public function test_page_url_attribute()
    {
        $page = Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => 'Test content',
            'active' => true,
        ]);

        $this->assertEquals(route('page.show', 'test-page'), $page->url);
    }

    public function test_page_active_scope_works()
    {
        // Create active and inactive pages
        Page::create(['title' => 'Active Page', 'slug' => 'active-page', 'active' => true]);
        Page::create(['title' => 'Inactive Page', 'slug' => 'inactive-page', 'active' => false]);

        // Test active scope
        $activePages = Page::active()->get();
        $this->assertCount(1, $activePages);
        $this->assertEquals('Active Page', $activePages->first()->title);
    }

    public function test_page_show_route_works()
    {
        // Create a test page
        Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => '<h1>Test Content</h1><p>This is a test page.</p>',
            'active' => true,
        ]);

        // Test that the page route works
        $response = $this->get('/page/test-page');

        $response->assertStatus(200);
        $response->assertSee('Test Page');
        $response->assertSee('Test Content');
    }

    public function test_page_show_route_returns_404_for_inactive_page()
    {
        // Create an inactive page
        Page::create([
            'title' => 'Inactive Page',
            'slug' => 'inactive-page',
            'content' => 'Test content',
            'active' => false,
        ]);

        // Test that inactive page returns 404
        $response = $this->get('/page/inactive-page');
        $response->assertStatus(404);
    }

    public function test_page_show_route_returns_404_for_nonexistent_page()
    {
        // Test that non-existent page returns 404
        $response = $this->get('/page/nonexistent-page');
        $response->assertStatus(404);
    }
}
