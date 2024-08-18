<?php

namespace Modules\Guideline\Console\Commands;

use Illuminate\Console\Command;

class GuidelineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:GuidelineCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guideline Command description';

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
