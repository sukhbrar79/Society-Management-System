<?php

namespace Modules\Parking\Console\Commands;

use Illuminate\Console\Command;

class ParkingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ParkingCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parking Command description';

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
