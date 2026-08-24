<?php

namespace App\Filament\Resources\PageResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpEditRecord;
use App\Filament\Resources\PageResource;
use Filament\Actions;

class EditPage extends LmpEditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
