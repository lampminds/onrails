<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Nuevos Productos',
                'description' => 'Descubre nuestra última colección de productos tecnológicos',
                'link' => '/store',
                'active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Ofertas Especiales',
                'description' => 'Aprovecha nuestras ofertas limitadas en productos seleccionados',
                'link' => '/store?sale=true',
                'active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Tecnología de Vanguardia',
                'description' => 'Los últimos avances en tecnología al alcance de tu mano',
                'link' => null,
                'active' => true,
                'order' => 3,
            ],
        ];

        foreach ($sliders as $sliderData) {
            Slider::create($sliderData);
        }
    }
}
