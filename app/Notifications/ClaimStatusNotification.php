<?php

namespace App\Notifications;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClaimStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Claim $claim
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusLabel = ucfirst(str_replace('_', ' ', $this->claim->status));
        $claimTypeLabel = Claim::labelForType($this->claim->claim_type);
        $farmerName = trim(implode(' ', array_filter([
            $this->claim->enrollment?->first_name,
            $this->claim->enrollment?->middle_name,
            $this->claim->enrollment?->surname,
        ])));

        $message = (new MailMessage)
            ->subject('Claim Status Update: '.$statusLabel)
            ->greeting('Hello!')
            ->line('Your claim status has been updated.')
            ->line('Status: '.$statusLabel)
            ->line('Claim Type: '.$claimTypeLabel)
            ->line('RSBSA Number: '.($this->claim->enrollment?->rsbsa_reference_number ?? 'N/A'))
            ->line('Farmer Name: '.($farmerName !== '' ? $farmerName : 'N/A'));

        if (! empty($this->claim->review_notes)) {
            $message->line('Review Notes: '.$this->claim->review_notes);
        }

        $message->line('Thank you for using the Department of Agriculture Claveria claim service.');

        if ($this->claim->status === Claim::STATUS_SUBMITTED) {
            $message->line('Your submission has been received and will be reviewed by an administrator.');
        }

        if ($this->claim->status === Claim::STATUS_UNDER_REVIEW) {
            $message->line('Your claim is currently under review.');
        }

        if ($this->claim->status === Claim::STATUS_APPROVED) {
            $message->line('Your claim has been approved.');
        }

        if ($this->claim->status === Claim::STATUS_REJECTED) {
            $message->line('Your claim has been rejected.');
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'claim_id' => $this->claim->id,
            'status' => $this->claim->status,
            'claim_type' => $this->claim->claim_type,
            'contact_email' => $this->claim->contact_email,
        ];
    }
}
