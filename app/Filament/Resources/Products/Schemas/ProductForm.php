<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('Product')
                ->columnSpanFull()
                // ->persistTabInQueryString() // remembers the active tab
                ->tabs([
                    Tab::make('Details')->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('product_code')
                            ->required(),
                        TextInput::make('price')
                            ->required(),
                        Select::make('status')
                            ->options([
                                'Draft' => 'Draft',
                                'Published' => 'Published',
                                'Archived' => 'Archived',
                            ]),
                        Select::make('category_id')
                            ->relationship('category', 'name'),
                        Select::make('season_id')
                            ->relationship('season', 'name'),
                    ]),
                    Tab::make('Images')->schema([
                        FileUpload::make('images')
                            ->label('Images')
                            ->multiple()                  // enable multi-select
                            ->reorderable()               // drag to reorder
                            ->downloadable()              // show download action
                            ->previewable(true)
                            ->directory('products')       // storage path: storage/app/public/products
                            ->disk('public')              // use the "public" disk
                            ->maxFiles(10)                // optional limit
                            ->preserveFilenames()         // optional, keep original names
                            ->imageEditor()               // optional built-crin editor
                            ->columnSpanFull(),
                    ]),
                ]),
        ]);
    }
}
