<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpListRecords;
use App\Filament\Resources\ProductResource;
use App\Models\Category;
use Filament\Actions;

class ListProducts extends LmpListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        $actions = parent::getHeaderActions();

        $actions[] = Actions\SelectAction::make('category')
            ->label(__('Categoría'))
            ->placeholder(__('Todas las categorías'))
            ->options($this->getHierarchicalCategoryOptions())
            ->action(function (array $data) {
                $categoryId = $data['category'] ?? null;
                $params = $categoryId ? ['category' => $categoryId] : [];
                return redirect(ProductResource::getUrl('index', $params));
            });

        return $actions;
    }

    /**
     * Build hierarchical options with indentation for parent/child categories.
     * Only include child categories (not parent categories).
     */
    private function getHierarchicalCategoryOptions(): array
    {
        $options = [];
        
        // Get all child categories (categories that have a parent)
        $childCategories = Category::getChildCategories();
        
        foreach ($childCategories as $child) {
            $options[$child->id] = $child->name;
            $this->appendChildrenOptions($options, $child, '— ');
        }

        return $options;
    }

    private function appendChildrenOptions(array &$options, Category $parent, string $prefix): void
    {
        foreach ($parent->children()->orderBy('name')->get() as $child) {
            $options[$child->id] = $prefix . $child->name;
            $this->appendChildrenOptions($options, $child, $prefix . '— ');
        }
    }
}


