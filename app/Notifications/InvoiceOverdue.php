<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceOverdue extends Notification
{
    use Queueable;

    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return ['mail','database']; // or other channels like 'database', 'sms', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Invoice Overdue Notice')
            ->line('Your invoice with ID: ' . $this->invoice->id . ' is overdue.')
            ->line('Due Date: ' . $this->invoice->due_date->format('Y-m-d'))
            ->line('Please make the payment as soon as possible to avoid any late fees.')
            ->action('View Invoice', url('/invoices/' . $this->invoice->id))
            ->line('Thank you for your prompt attention to this matter.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'invoice_id' => $this->invoice->id,
            'due_date' => $this->invoice->due_date->format('Y-m-d'),
            'message' => 'Your invoice with ID ' . $this->invoice->id . ' is overdue. Please make the payment as soon as possible.',
            'subject' => 'Invoice Overdue Notice',
            'link' => url('/invoices/' . $this->invoice->id),
        ];
    }
}
