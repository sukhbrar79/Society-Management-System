<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ComplaintAssigned extends Notification
{
    use Queueable;

    protected $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function via($notifiable)
    {
        return ['database']; // Use database notifications
    }

    public function toDatabase($notifiable)
{
    return [
        'complaint_id' => $this->complaint->id,
        'description' => $this->complaint->description,
        'assigned_to' => $this->complaint->assigned_to,
        'message' => 'You have been assigned a new complaint.',
        'title' => 'Complaint Assigned',
        'text' => 'A new complaint has been assigned to you. Please check the details.',
        'url_backend' => url('/admin/complaints/' . $this->complaint->id), // Add backend URL if necessary or remove if not used
        'url_frontend' => '', // Add frontend URL if necessary or remove if not used
        'module' => 'complaints', // Fixed missing key and provided a value
        'action_url' => url('/admin/complaints/' . $this->complaint->id),
    ];
}

}
