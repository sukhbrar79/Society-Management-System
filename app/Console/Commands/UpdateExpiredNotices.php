<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\NoticeBoard\Models\NoticeBoard; // Import your model here
use Carbon\Carbon;

class UpdateExpiredNotices extends Command
{
    protected $signature = 'notices:update-expired';
    protected $description = 'Update the status of notices where the expiry_date has passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Update status to 0 where expiry_date is less than now
        Noticeboard::where('expiry_date', '<', $now)
                   ->where('status', '!=', 0) // Only update if status is not already 0
                   ->update(['status' => 0]);

        $this->info('Expired notices have been updated.');
    }
}
