<?php

namespace Tests\Feature;

use App\Models\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_with_sliders()
    {
        // Create some test sliders
        Slider::create([
            'title' => 'Test Slider 1',
            'description' => 'Test Description 1',
            'link' => '/test-link',
            'active' => true,
            'order' => 1,
        ]);

        Slider::create([
            'title' => 'Test Slider 2',
            'description' => 'Test Description 2',
            'link' => null,
            'active' => true,
            'order' => 2,
        ]);

        // Test that the home page loads successfully
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test Slider 1');
        $response->assertSee('Test Description 1');
        $response->assertSee('Test Slider 2');
        $response->assertSee('Test Description 2');
    }

    public function test_home_page_shows_fallback_when_no_sliders()
    {
        // Test that the home page loads with fallback content when no sliders exist
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Nuestros Productos');
    }

    public function test_only_active_sliders_are_shown()
    {
        // Create active and inactive sliders
        Slider::create([
            'title' => 'Active Slider',
            'description' => 'This should be shown',
            'active' => true,
            'order' => 1,
        ]);

        Slider::create([
            'title' => 'Inactive Slider',
            'description' => 'This should not be shown',
            'active' => false,
            'order' => 2,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Active Slider');
        $response->assertSee('This should be shown');
        $response->assertDontSee('Inactive Slider');
        $response->assertDontSee('This should not be shown');
    }
}
