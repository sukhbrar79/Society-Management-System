<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Modules\Invoice\Models\Invoice;

class InvoiceCreated extends Notification
{
    use Queueable;

    protected $invoice;

    /**
     * Create a new notification instance.
     *
     * @param  Invoice  $invoice
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Invoice Created')
            ->line('A new invoice has been created for you.')
            ->line('Invoice Number: ' . $this->invoice->invoice_number)
            ->line('Amount: $' . number_format($this->invoice->amount, 2))
            ->line('Invoice Date: ' . $this->invoice->invoice_date)
            ->line('Due Date: ' . $this->invoice->due_date)
            ->action('View Invoice', url('/invoices/' . $this->invoice->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'invoice_id' => $this->invoice->id,
            'invoice_number' => $this->invoice->invoice_number,
            'amount' => $this->invoice->amount,
            'invoice_date' => $this->invoice->invoice_date,
            'due_date' => $this->invoice->due_date,
            'message' => 'A new invoice has been created for you.',
            'subject' => 'New Invoice Created',
            'link' => '',
        ];
    }
}
