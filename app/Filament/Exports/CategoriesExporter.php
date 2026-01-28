<?php

namespace App\Filament\Exports;

use App\Models\Categories;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CategoriesExporter extends Exporter
{
    protected static ?string $model = Categories::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make("name")->label("Category Name"),
            ExportColumn::make("amount")->label("Total Expense"),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your categories export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
