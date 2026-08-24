<?php

namespace App\Models;

use Lampminds\Customization\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'link',
        'active',
        'order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slider_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->singleFile()
            ->useFallbackUrl('/img/placeholder.png')
            ->useFallbackPath(public_path('/img/placeholder.png'))
            ->useDisk('sliders');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10)
            ->performOnCollections('slider_images')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(600)
            ->sharpen(10)
            ->performOnCollections('slider_images')
            ->nonQueued();
    }

    /**
     * Scope for active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope for ordered sliders
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Get the slider image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('slider_images');
    }

    /**
     * Get the slider image URL with conversion
     */
    public function getImageUrlWithConversion(string $conversion = ''): ?string
    {
        return $this->getFirstMediaUrl('slider_images', $conversion);
    }
}
