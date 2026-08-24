<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables;
use Filament\Tables\Table;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormTitle;
use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpResource;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableTitle;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableToggle;

class SliderResource extends LmpResource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $modelLabel = 'Slider';

    protected static ?string $pluralModelLabel = 'Sliders';

    protected static ?string $navigationLabel = 'Sliders';

    public static function getFormTitle($record): string
    {
        return $record->title ?? 'Nuevo Slider';
    }

    protected static function getMainFormSchema(Form $form): array
    {
        return [
            Section::make('')
                ->schema([
                    LmpFormTitle::make('Título', 'title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('description')
                        ->label('Descripción')
                        ->maxLength(1000)
                        ->columnSpanFull(),

                    TextInput::make('link')
                        ->label('Enlace')
                        ->helperText('Puede ser un enlace relativo (/store?category=10) o absoluto (https://google.com)')
                        ->maxLength(255)
                        ->rules([
                            'nullable',
                            'string',
                            'max:255',
                        ])
                        ->columnSpanFull(),

                    Toggle::make('active')
                        ->default(true)
                        ->label('Activo'),

                    SpatieMediaLibraryFileUpload::make('slider_images')
                        ->label('Imagen del Slider')
                        ->collection('slider_images')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                        ->maxSize(5120) // 5MB
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('slider_images')
                    ->label('Imagen')
                    ->collection('slider_images')
                    ->conversion('thumb')
                    ->size(60),

                LmpTableTitle::make('Título', 'title'),

                LmpTableTitle::make('Descripción', 'description')
                    ->limit(50),

                LmpTableTitle::make('Enlace', 'link')
                    ->limit(30)
                    ->default('Sin enlace'),

                LmpTableToggle::make('Activo', 'active'),

            ])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
