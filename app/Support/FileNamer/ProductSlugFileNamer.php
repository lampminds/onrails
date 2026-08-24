<?php

namespace App\Support\FileNamer;

use Spatie\MediaLibrary\Support\FileNamer\FileNamer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Conversions\Conversion;

class ProductSlugFileNamer extends FileNamer
{
    public function originalFileName(string $fileName): string
    {
        $extLength = strlen(pathinfo($fileName, PATHINFO_EXTENSION));
        $baseName = substr($fileName, 0, strlen($fileName) - ($extLength ? $extLength + 1 : 0));
        return $baseName;
    }

    public function fileName(Media $media): string
    {
        $model = $media->model;
        
        // Check if this is a product model
        if (!$model || !method_exists($model, 'getSlugAttribute')) {
            return $media->file_name;
        }
        
        $slug = $model->slug;
        $extension = pathinfo($media->file_name, PATHINFO_EXTENSION);
        
        // Get the count of existing media for this product
        $existingCount = $model->getMedia('products')->count();
        
        // If this is the first image, no number needed
        if ($existingCount === 0) {
            return "{$slug}.{$extension}";
        }
        
        // For additional images, add a trailing number
        return "{$slug}-{$existingCount}.{$extension}";
    }

    public function conversionFileName(string $fileName, Conversion $conversion): string
    {
        $strippedFileName = pathinfo($fileName, PATHINFO_FILENAME);
        return "{$strippedFileName}-{$conversion->getName()}";
    }

    public function responsiveFileName(string $fileName): string
    {
        return pathinfo($fileName, PATHINFO_FILENAME);
    }
}
