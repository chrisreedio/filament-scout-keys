<?php

namespace ChrisReedIO\ScoutKeys\Filament\Enums;

use ChrisReedIO\ScoutKeys\Enums\ScoutEngineType as BaseEngineType;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ScoutEngineType: string implements HasColor, HasIcon, HasLabel
{
    case Meilisearch = 'meilisearch';
    case Typesense = 'typesense';

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Meilisearch => Color::Violet,
            self::Typesense => Color::Blue,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Meilisearch, self::Typesense => 'heroicon-o-magnifying-glass',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Meilisearch => 'Meilisearch',
            self::Typesense => 'Typesense',
        };
    }

    public static function fromEngine(BaseEngineType $engine): ScoutEngineType
    {
        return match ($engine) {
            BaseEngineType::Meilisearch => ScoutEngineType::Meilisearch,
            BaseEngineType::Typesense => ScoutEngineType::Typesense,
        };
    }
}
