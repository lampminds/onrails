<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Table;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormTitle;
use Lampminds\Customization\Filament\LmpCustomization\FormComponents\LmpFormRichEditor;
use Lampminds\Customization\Filament\LmpCustomization\Resources\LmpResource;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableTitle;
use Lampminds\Customization\Filament\LmpCustomization\TableComponents\LmpTableToggle;

class PageResource extends LmpResource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'Página';

    protected static ?string $pluralModelLabel = 'Páginas';

    protected static ?string $navigationLabel = 'Páginas';

    public static function getFormTitle($record): string
    {
        return $record->title ?? 'Nueva Página';
    }

    protected static function getMainFormSchema(Form $form): array
    {
        return [
            Section::make('')
                ->schema([
                    LmpFormTitle::make('Título', 'title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation !== 'create') {
                                return;
                            }
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }),
                    
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('URL amigable para la página (se genera automáticamente desde el título)')
                        ->rules([
                            'required',
                            'string',
                            'max:255',
                        ]),
                    
                    LmpFormRichEditor::make('Contenido', 'content')
                        ->columnSpanFull(),
                    
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
                
                LmpTableTitle::make('Slug', 'slug')
                    ->limit(30),
                
                LmpTableToggle::make('Activo', 'active'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('title');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
