<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('active', true);

        // Filter by category if selected
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filter by search term if provided
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by price range if provided
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort products
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortOrder);
                break;
            case 'name':
            default:
                $query->orderBy('name', $sortOrder);
                break;
        }

        // Get paginated products
        $perPage = $request->get('per_page', 12);
        $products = $query->with(['categories'])->paginate($perPage);

        // Get all categories for sidebar
        $categories = Category::query()
            ->whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        // Get active menus
        $menus = Menu::active()
            ->ordered()
            ->get();

        return view('store.index', compact('products', 'categories', 'menus'));
    }

    public function show(Product $product)
    {
        // Get related products (same categories, excluding current product)
        $relatedProducts = Product::query()
            ->where('active', true)
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function ($query) use ($product) {
                $query->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->with(['categories'])
            ->limit(4)
            ->get();

        // Get active menus
        $menus = Menu::active()
            ->ordered()
            ->get();

        return view('store.product', compact('product', 'relatedProducts', 'menus'));
    }
}
