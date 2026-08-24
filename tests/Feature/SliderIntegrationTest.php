<?php

namespace Tests\Feature;

use App\Models\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SliderIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_slider_resource_works_with_lampminds_customization()
    {
        // Create a test slider
        $slider = Slider::create([
            'title' => 'Test Slider',
            'description' => 'Test Description',
            'link' => '/store?category=1',
            'active' => true,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('sliders', [
            'title' => 'Test Slider',
            'active' => true,
            'order' => 1,
        ]);

        // Test that the slider can be retrieved
        $retrievedSlider = Slider::find($slider->id);
        $this->assertEquals('Test Slider', $retrievedSlider->title);
        $this->assertTrue($retrievedSlider->active);
    }

    public function test_slider_link_validation_works()
    {
        // Test valid relative link
        $slider1 = Slider::create([
            'title' => 'Test 1',
            'link' => '/store?category=1',
            'active' => true,
            'order' => 1,
        ]);
        $this->assertDatabaseHas('sliders', ['link' => '/store?category=1']);

        // Test valid absolute link
        $slider2 = Slider::create([
            'title' => 'Test 2',
            'link' => 'https://google.com',
            'active' => true,
            'order' => 2,
        ]);
        $this->assertDatabaseHas('sliders', ['link' => 'https://google.com']);

        // Test null link
        $slider3 = Slider::create([
            'title' => 'Test 3',
            'link' => null,
            'active' => true,
            'order' => 3,
        ]);
        $this->assertDatabaseHas('sliders', ['link' => null]);
    }

    public function test_slider_ordering_works()
    {
        // Create sliders with different orders
        Slider::create(['title' => 'First', 'order' => 1, 'active' => true]);
        Slider::create(['title' => 'Third', 'order' => 3, 'active' => true]);
        Slider::create(['title' => 'Second', 'order' => 2, 'active' => true]);

        // Test ordered scope
        $orderedSliders = Slider::ordered()->get();
        $this->assertEquals('First', $orderedSliders[0]->title);
        $this->assertEquals('Second', $orderedSliders[1]->title);
        $this->assertEquals('Third', $orderedSliders[2]->title);
    }

    public function test_slider_active_scope_works()
    {
        // Create active and inactive sliders
        Slider::create(['title' => 'Active', 'active' => true, 'order' => 1]);
        Slider::create(['title' => 'Inactive', 'active' => false, 'order' => 2]);

        // Test active scope
        $activeSliders = Slider::active()->get();
        $this->assertCount(1, $activeSliders);
        $this->assertEquals('Active', $activeSliders->first()->title);
    }
}
