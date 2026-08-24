<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share hierarchical category options with public header
        View::composer('partials.header-public', function ($view) {
            $options = [];

            // Get all child categories (categories that have a parent)
            $childCategories = Category::getChildCategories();
            
            foreach ($childCategories as $child) {
                $options[$child->id] = $child->name;
                
                // Add grandchildren (level 3) if any
                $grandchildren = $child->children()->orderBy('name')->get();
                foreach ($grandchildren as $grandchild) {
                    $options[$grandchild->id] = '— ' . $grandchild->name;
                    
                    // Continue for deeper levels if needed
                    $this->addDescendants($options, $grandchild, '— ');
                }
            }

            $view->with('publicCategoryOptions', $options);
        });

        // Share categories for store page
        View::composer('store.index', function ($view) {
            $categories = Category::query()
                ->whereNull('parent_id')
                ->with(['children' => function ($query) {
                    $query->orderBy('name');
                }])
                ->orderBy('name')
                ->get();

            $view->with('sidebarCategories', $categories);
        });
    }

    /**
     * Recursively add descendants for levels deeper than 3
     */
    private function addDescendants(&$options, Category $parent, string $prefix): void
    {
        $children = $parent->children()->orderBy('name')->get();
        foreach ($children as $child) {
            $options[$child->id] = $prefix . '— ' . $child->name;
            $this->addDescendants($options, $child, $prefix . '— ');
        }
    }
}
