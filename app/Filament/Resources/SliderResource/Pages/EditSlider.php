<?php

namespace App\Filament\Resources\SliderResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpEditRecord;
use App\Filament\Resources\SliderResource;
use Filament\Actions;

class EditSlider extends LmpEditRecord
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
