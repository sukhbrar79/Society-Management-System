<?php

namespace Modules\Block\Console\Commands;

use Illuminate\Console\Command;

class BlockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:BlockCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Block Command description';

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
