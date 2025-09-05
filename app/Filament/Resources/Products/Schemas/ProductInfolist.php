<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Product Images')
                ->columnSpanFull()
                ->schema([
                    ImageEntry::make('images')
                        ->disk('public')
                        ->imageSize(300)
                        ->hiddenLabel()
                        ->extraAttributes([
                            'class' => 'justify-content-around',
                        ]),
                ]),

            Section::make('Product Details')
                ->columnSpanFull()
                ->columns(2) // two columns for text entries
                ->schema([
                    TextEntry::make('title'),
                    TextEntry::make('product_code'),
                    TextEntry::make('price'),
                    TextEntry::make('category_id')
                        ->label('Store')
                        ->getStateUsing(fn($record) => $record->category?->name ?? 'N/A'),
                    TextEntry::make('season_id')
                        ->label('Season')
                        ->getStateUsing(fn($record) => $record->season?->name ?? 'N/A'),
                ]),
        ]);
    }
}
