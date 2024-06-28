<?php

namespace Modules\Complaint\Console\Commands;

use Illuminate\Console\Command;

class ComplaintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ComplaintCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Complaint Command description';

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
