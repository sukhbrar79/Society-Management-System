<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Invoice\Models\Invoice;
use App\Notifications\InvoiceOverdue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class UpdateOverdueInvoices extends Command
{
    protected $signature = 'invoices:update-overdue';
    protected $description = 'Update status of overdue invoices';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Find all invoices where the due_date is less than today and status is not already overdue
        $invoices = Invoice::where('due_date', '<', $now)
                           ->where('status', '<>', 'Overdue')
                           ->where('status', '<>', 'Paid')
                           ->get();

        foreach ($invoices as $invoice) {
            $invoice->status = 'overdue';
            $invoice->save();

            $invoice->user->notify(new InvoiceOverdue($invoice));

        }

        $this->info('Overdue invoices updated and notifications sent successfully.');
    }
}
