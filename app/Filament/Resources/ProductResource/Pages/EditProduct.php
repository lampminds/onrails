<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpEditRecord;
use App\Filament\Resources\ProductResource;
use Filament\Actions;

class EditProduct extends LmpEditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}


