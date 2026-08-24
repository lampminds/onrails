<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::active()
            ->ordered()
            ->get();

        $menus = Menu::active()
            ->ordered()
            ->get();

        return view('welcome', compact('sliders', 'menus'));
    }

}
