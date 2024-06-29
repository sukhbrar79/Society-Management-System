<?php

namespace Modules\Flat\Console\Commands;

use Illuminate\Console\Command;

class FlatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:FlatCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flat Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
