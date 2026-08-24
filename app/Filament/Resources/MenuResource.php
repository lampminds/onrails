<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Table;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormTitle;
use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpResource;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableTitle;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableToggle;

class MenuResource extends LmpResource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $modelLabel = 'Menú';

    protected static ?string $pluralModelLabel = 'Menús';

    protected static ?string $navigationLabel = 'Menús';

    public static function getFormTitle($record): string
    {
        return $record->title ?? 'Nuevo Menú';
    }

    protected static function getMainFormSchema(Form $form): array
    {
        return [
            Section::make('')
                ->schema([
                    LmpFormTitle::make('Título', 'title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('link')
                        ->label('Enlace')
                        ->helperText('Puede ser un enlace relativo (/store?category=10) o absoluto (https://google.com)')
                        ->required()
                        ->maxLength(255)
                        ->rules([
                            'required',
                            'string',
                            'max:255',
                        ]),

                    Toggle::make('active')
                        ->default(true)
                        ->label('Activo'),
                ])
                ->columns(2),
        ];
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                LmpTableTitle::make('Título', 'title'),

                LmpTableTitle::make('Enlace', 'link')
                    ->limit(50),

                LmpTableToggle::make('Activo', 'active'),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
