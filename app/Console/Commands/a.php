<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class a extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'a';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php artisan';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return "php artisan";
    }
}
