<?php

namespace App\Filament\Resources\SliderResource\Pages;

use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpListRecords;
use App\Filament\Resources\SliderResource;
use Filament\Actions;

class ListSliders extends LmpListRecords
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
