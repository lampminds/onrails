<?php

namespace App\Filament\Resources\PageResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpListRecords;
use App\Filament\Resources\PageResource;
use Filament\Actions;

class ListPages extends LmpListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
