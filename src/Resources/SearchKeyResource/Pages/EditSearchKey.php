<?php

namespace ChrisReedIO\ScoutKeys\Filament\Resources\SearchKeyResource\Pages;

use ChrisReedIO\ScoutKeys\Filament\Resources\SearchKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSearchKey extends EditRecord
{
    protected static string $resource = SearchKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
