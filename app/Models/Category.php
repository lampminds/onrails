<?php

namespace App\Models;

use Lampminds\Customization\Models\BaseModel;
use Illuminate\Support\Str;

Class Category extends BaseModel
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'order',
    ];

    protected static function booted()
    {
        static::creating(function (Category $model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        // thru category_product table
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    public function activeProducts()
    {
        return $this->products()->where('active', true);
    }

    /**
     * Check if this category is a parent (has children)
     */
    public function isParent(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Check if this category is a child (has a parent)
     */
    public function isChild(): bool
    {
        return !is_null($this->parent_id);
    }

    /**
     * Get only child categories (categories that have a parent)
     */
    public static function getChildCategories()
    {
        return static::whereNotNull('parent_id')->orderBy('name')->get();
    }

}
