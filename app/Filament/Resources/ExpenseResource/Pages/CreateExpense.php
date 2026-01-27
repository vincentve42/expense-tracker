<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use App\Models\Categories;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data["user_id"] = Auth::id();

        $update_amount = Categories::find($data["category_id"]);
        
        $update_amount->amount += $data["amount"];

        $update_amount->save();
        
        return $data;
    }
}
