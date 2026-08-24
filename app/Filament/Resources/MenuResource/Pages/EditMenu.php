<?php

namespace App\Filament\Resources\MenuResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpEditRecord;
use App\Filament\Resources\MenuResource;
use Filament\Actions;

class EditMenu extends LmpEditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
