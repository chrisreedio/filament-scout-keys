<?php

namespace ChrisReedIO\ScoutKeys\Filament\Resources\UserResource\RelationManagers;

use ChrisReedIO\ScoutKeys\Filament\Enums\ScoutEngineType;
use ChrisReedIO\ScoutKeys\Models\SearchKey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;

class SearchKeysRelationManager extends RelationManager
{
    protected static string $relationship = 'searchKeys';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('uuid')
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('engine')
                    ->badge()
                    ->color(fn (SearchKey $key) => ScoutEngineType::fromEngine($key->engine)->getColor())
                    ->formatStateUsing(fn (SearchKey $key) => ScoutEngineType::fromEngine($key->engine)->getLabel())
                    ->icon(fn (SearchKey $key) => ScoutEngineType::fromEngine($key->engine)->getIcon()),
                Tables\Columns\IconColumn::make('is_scoped')
                    ->label('Scoped')
                    ->boolean()
                    ->getStateUsing(fn (SearchKey $key) => $key->scoped_key !== null),
                Tables\Columns\TextColumn::make('expires_at')
                    ->formatStateUsing(fn (SearchKey $key) => $key->expires_at->diffForHumans())
                    ->icon(fn (
                        SearchKey $key
                    ) => $key->expires_at->isPast() ? 'heroicon-o-exclamation-circle' : 'heroicon-o-check-badge')
                    ->color(fn (SearchKey $key) => $key->expires_at->isPast() ? Color::Red : Color::Green)
                    // ->dateTime('Y-m-d H:i:s')
                    // ->tooltip(fn (SearchKey $key) => $key->expires_at->diffForHumans()),
                    ->tooltip(fn (SearchKey $key) => $key->expires_at->format('Y-m-d H:i:s')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('Generate')
                    ->label('Generate')
                    ->action(function (Tables\Actions\Action $action) {
                        // $action->getrecord
                    }),
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('revoke')
                    ->label('Revoke')
                    // ->icon('heroicon-s-backspace')
                    ->icon('heroicon-s-no-symbol')
                    ->color('danger')
                    ->button()
                    ->action(function (SearchKey $key) {
                        $key->revoke();
                        $key->delete();
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
