<?php

namespace App\Filament\Imports;

use App\Models\Categories;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CategoriesImporter extends Importer
{
    protected static ?string $model = Categories::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make("Name")->label("Category Name"),
            ImportColumn::make("amount")->label("Amount")
        ];
    }

    public function resolveRecord(): ?Categories
    {
        // return Categories::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Categories();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your categories import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
