<?php

namespace App\Filament\Resources\MenuResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpListRecords;
use App\Filament\Resources\MenuResource;
use Filament\Actions;

class ListMenus extends LmpListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
