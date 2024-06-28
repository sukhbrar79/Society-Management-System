<?php

namespace Modules\Visitor\Console\Commands;

use Illuminate\Console\Command;

class VisitorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:VisitorCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Visitor Command description';

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
