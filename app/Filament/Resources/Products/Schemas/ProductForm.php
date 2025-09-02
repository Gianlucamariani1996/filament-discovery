<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('product_code')
                    ->required(),
                TextInput::make('price')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                Select::make('season_id')
                    ->relationship('season', 'name'),
            ]);
    }
}
