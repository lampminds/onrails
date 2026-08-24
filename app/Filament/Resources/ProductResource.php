<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables;
use Filament\Tables\Table;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormCurrency;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormRichEditor;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormTitle;
use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpResource;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableCurrency;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableTitle;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableToggle;

class ProductResource extends LmpResource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $modelLabel = 'Producto';

    protected static ?string $pluralModelLabel = 'Productos';

    protected static ?string $navigationLabel = 'Productos';

    public static function getFormTitle($record): string
    {
        return $record->name;
    }

    protected static function getMainFormSchema(Form $form): array
    {
        return [
            Section::make('')
                ->schema([
                    LmpFormTitle::make('Nombre', 'name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->disabled()
                        ->hiddenOn(['create', 'edit'])
                        ->maxLength(255),
                    LmpFormRichEditor::make('Descripción', 'description')
                        ->columnSpanFull(),
                    LmpFormCurrency::make('Precio', 'price'),
                    Toggle::make('active')
                        ->default(true)
                        ->label('Activo'),
                    Toggle::make('featured')
                        ->default(false)
                        ->label('Destacado')
                        ->helperText('Los productos destacados se muestran en la página de inicio.'),
                    CheckboxList::make('categories')
                        ->label('Categorías')
                        ->options(Category::query()->pluck('name', 'id'))
                        ->relationship('categories', 'name')
                        ->columns(2),
                    SpatieMediaLibraryFileUpload::make('products')
                        ->label('Imágenes del Producto')
                        ->collection('products')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->downloadable()
                        ->openable(),
                    LmpFormRichEditor::make('Historia', 'history'),
                ])
                ->columns(2),
        ];
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                LmpTableTitle::make('Nombre', 'name'),
                LmpTableCurrency::make(fn(Product $record): ?float => $record->price, 'Precio', 'price'),
                LmpTableToggle::make('Activo', 'active'),
                LmpTableToggle::make('Destacado', 'featured'),
                LmpTableTitle::make('Categorías', 'categories.name')
                    ->default('Sin categorías'),
            ])
            ->defaultSort('name');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}


