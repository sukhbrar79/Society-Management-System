<?php

namespace Modules\EmergencyContact\Console\Commands;

use Illuminate\Console\Command;

class EmergencyContactCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:EmergencyContactCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'EmergencyContact Command description';

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
