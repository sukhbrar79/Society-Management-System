<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Invoice\Models\Invoice;
use App\Models\Users;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Notifications\InvoiceCreated;

class GenerateInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generate invoices for all residents every 5 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info('GenerateInvoices command started.');
        $residents = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'resident');
        })->get();

        foreach ($residents as $resident) {
            $invoice = Invoice::factory()->create([
                'resident_id' => $resident->id,
                'amount' => 100.0,
                'invoice_date' => Carbon::now()->toDateString(),
                'due_date' => Carbon::now()->addDays(30)->toDateString(),
                'status' => 'Pending',
            ]);
            $resident->notify(new InvoiceCreated($invoice));
        }
        Log::info('GenerateInvoices command completed. Invoices generated for ' . $residents->count() . ' residents.');
        $this->info('Invoices generated successfully!');
    }
}
