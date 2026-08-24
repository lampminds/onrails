<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Menu;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::findBySlug($slug);

        if (!$page) {
            abort(404);
        }

        // Get active menus for navigation
        $menus = Menu::active()
            ->ordered()
            ->get();

        return view('page.show', compact('page', 'menus'));
    }
}
