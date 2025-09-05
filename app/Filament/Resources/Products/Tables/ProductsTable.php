<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\ExportBulkAction;
use App\Filament\Exports\ProductExporter;
use Filament\Actions\ImportAction;
use App\Filament\Imports\ProductImporter;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Category;
use App\Models\Season;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.0')
                    ->disk('public')
                    ->imageSize(100),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('product_code')
                    ->searchable(),
                TextColumn::make('price')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('season.name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(fn() => Category::orderBy('name')->pluck('name', 'id'))
                    ->multiple()
                    ->preload(),
                SelectFilter::make('season_id')
                    ->label('Season')
                    ->options(fn() => Season::orderBy('name')->pluck('name', 'id'))
                    ->multiple()
                    ->preload()
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver()
                    ->label('') // remove label text
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->exporter(ProductExporter::class),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(ProductImporter::class)
            ]);;
    }
}
