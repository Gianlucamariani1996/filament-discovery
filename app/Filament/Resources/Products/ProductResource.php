<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Assets';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        // The Section has 5 columns.
        // Left Group takes 3 columns → shows stacked images (1 column inside).
        // Right Group takes 2 columns → splits that space into 2 columns for text fields.
        return $schema->schema([
            Section::make('Product Details')
                ->columnSpanFull()
                ->columns(5)
                ->schema([
                    Group::make()
                        ->columnSpan(3)
                        ->columns(1)
                        ->schema([
                            ImageEntry::make('images')
                                ->disk('public')
                        ]),
                    Group::make()
                        ->columnSpan(2)
                        ->columns(2)
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('product_code'),
                            TextEntry::make('price'),
                            TextEntry::make('category_id')
                                ->label('Store')
                                ->getStateUsing(fn($record) => $record->category?->name ?? 'N/A'),
                        ]),
                ]),
        ]);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
        ];
    }
}
