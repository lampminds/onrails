<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormTitle;
use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpResource;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableTitle;

class CategoryResource extends LmpResource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Categoría';

    protected static ?string $pluralModelLabel = 'Categorías';

    protected static ?string $navigationLabel = 'Categorías';

    public static function getFormTitle($record): string
    {
        return $record->name;
    }

    public static function getMainFormSchema(Form $form): array
    {
        return [
            LmpFormTitle::make('Nombre', 'name')
                ->required()
                ->maxLength(255),
            LmpFormTitle::make('Slug', 'slug')
                ->disabled()
                ->hiddenOn(['create', 'edit'])
                ->maxLength(255),
            Select::make('parent_id')
                ->label('Categoría Padre')
                ->options(Category::whereNull('parent_id')->pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->helperText('Solo las categorías padre pueden ser seleccionadas como padres'),
        ];
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                LmpTableTitle::make('Nombre', 'name'),
                LmpTableTitle::make('Slug', 'slug'),
                LmpTableTitle::make('parent')
                    ->label('Padre')
                    ->default('N/A')
                    ->getStateUsing(function (Category $record) {
                        return $record->parent?->name ?? 'N/A';
                    }),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
