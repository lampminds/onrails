<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Home',
                'link' => '/',
                'active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Tienda',
                'link' => '/store',
                'active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Contacto',
                'link' => '/contact',
                'active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Sobre Nosotros',
                'link' => '/about',
                'active' => true,
                'order' => 4,
            ],
        ];

        foreach ($menus as $menuData) {
            Menu::create($menuData);
        }
    }
}
