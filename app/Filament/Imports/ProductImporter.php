<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('title')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('product_code')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('price')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('category')
                ->relationship(),
            ImportColumn::make('season')
                ->relationship(),
            ImportColumn::make('images')
                ->castStateUsing(function ($state) {
                    if (blank($state)) return null;
                    return collect(is_array($state) ? $state : [$state])
                        ->flatMap(fn($v) => is_string($v) ? explode(',', $v) : [$v])
                        ->map(fn($p) => trim(str_replace(['public/', 'storage/'], '', ltrim($p, '/'))))
                        ->filter()
                        ->values()
                        ->all();
                }),
            ImportColumn::make('status'),
        ];
    }

    public function resolveRecord(): Product
    {
        return Product::firstOrNew([
            'product_code' => $this->data['product_code'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
