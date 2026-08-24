<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user for the foreign key constraints
        User::factory()->create(['id' => 1]);
    }

    public function test_menu_resource_works_with_lampminds_customization()
    {
        // Create a test menu
        $menu = Menu::create([
            'title' => 'Test Menu',
            'link' => '/test-link',
            'active' => true,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('menus', [
            'title' => 'Test Menu',
            'active' => true,
            'order' => 1,
        ]);

        // Test that the menu can be retrieved
        $retrievedMenu = Menu::find($menu->id);
        $this->assertEquals('Test Menu', $retrievedMenu->title);
        $this->assertTrue($retrievedMenu->active);
    }

    public function test_menu_external_link_detection()
    {
        // Test external link
        $externalMenu = Menu::create([
            'title' => 'External',
            'link' => 'https://google.com',
            'active' => true,
            'order' => 1,
        ]);
        $this->assertTrue($externalMenu->isExternal());

        // Test internal link
        $internalMenu = Menu::create([
            'title' => 'Internal',
            'link' => '/store',
            'active' => true,
            'order' => 2,
        ]);
        $this->assertFalse($internalMenu->isExternal());
    }

    public function test_menu_link_attributes()
    {
        // Test external link attributes
        $externalMenu = Menu::create([
            'title' => 'External',
            'link' => 'https://google.com',
            'active' => true,
            'order' => 1,
        ]);
        
        $attributes = $externalMenu->getLinkAttributes();
        $this->assertEquals('_blank', $attributes['target']);
        $this->assertEquals('noopener noreferrer', $attributes['rel']);

        // Test internal link attributes
        $internalMenu = Menu::create([
            'title' => 'Internal',
            'link' => '/store',
            'active' => true,
            'order' => 2,
        ]);
        
        $attributes = $internalMenu->getLinkAttributes();
        $this->assertEmpty($attributes);
    }

    public function test_menu_ordering_works()
    {
        // Create menus with different orders
        Menu::create(['title' => 'First', 'link' => '/first', 'order' => 1, 'active' => true]);
        Menu::create(['title' => 'Third', 'link' => '/third', 'order' => 3, 'active' => true]);
        Menu::create(['title' => 'Second', 'link' => '/second', 'order' => 2, 'active' => true]);

        // Test ordered scope
        $orderedMenus = Menu::ordered()->get();
        $this->assertEquals('First', $orderedMenus[0]->title);
        $this->assertEquals('Second', $orderedMenus[1]->title);
        $this->assertEquals('Third', $orderedMenus[2]->title);
    }

    public function test_menu_active_scope_works()
    {
        // Create active and inactive menus
        Menu::create(['title' => 'Active', 'link' => '/active', 'active' => true, 'order' => 1]);
        Menu::create(['title' => 'Inactive', 'link' => '/inactive', 'active' => false, 'order' => 2]);

        // Test active scope
        $activeMenus = Menu::active()->get();
        $this->assertCount(1, $activeMenus);
        $this->assertEquals('Active', $activeMenus->first()->title);
    }

    public function test_home_page_loads_with_menus()
    {
        // Create some test menus
        Menu::create([
            'title' => 'Test Menu 1',
            'link' => '/test1',
            'active' => true,
            'order' => 1,
        ]);

        Menu::create([
            'title' => 'Test Menu 2',
            'link' => 'https://google.com',
            'active' => true,
            'order' => 2,
        ]);

        // Test that the home page loads successfully
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test Menu 1');
        $response->assertSee('Test Menu 2');
    }
}
