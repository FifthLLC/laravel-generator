<?php

namespace Fifth\Generator\Commands;

use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Support\Facades\Schema;

class MigrateRefreshCommand extends RefreshCommand
{
    public function handle(): void
    {
        Schema::disableForeignKeyConstraints();

        parent::handle();
    }
}
