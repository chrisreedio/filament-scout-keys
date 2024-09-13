<?php

namespace ChrisReedIO\FilamentScoutKeys\Commands;

use Illuminate\Console\Command;

class FilamentScoutKeysCommand extends Command
{
    public $signature = 'filament-scout-keys';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
