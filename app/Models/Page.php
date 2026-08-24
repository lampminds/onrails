<?php

namespace App\Models;

use Lampminds\Customization\Models\BaseModel;
use Illuminate\Support\Str;

class Page extends BaseModel
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function (Page $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::updating(function (Page $model) {
            if ($model->isDirty('title') && empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    /**
     * Scope for active pages
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Get the page URL
     */
    public function getUrlAttribute(): string
    {
        return route('page.show', $this->slug);
    }

    /**
     * Find page by slug
     */
    public static function findBySlug(string $slug): ?Page
    {
        return static::where('slug', $slug)
            ->where('active', true)
            ->first();
    }
}
