<?php

namespace App\Models;

use Lampminds\Customization\Models\BaseModel;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

Class Product extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'history',
        'price',
        'active',
        'featured',
    ];

    protected static function booted()
    {
        static::creating(function (Product $model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->acceptsFile(function (File $file) {
                // Max 2MB file size
                return $file->size <= 2 * 1024 * 1024;
            })
            ->useFallbackUrl('/images/placeholder.png')
            ->useFallbackPath(public_path('/images/placeholder.png'))
            ->useDisk('products');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->fit(Fit::Contain, 600, 600)
            ->performOnCollections('products')
            ->nonQueued();
    }
}
