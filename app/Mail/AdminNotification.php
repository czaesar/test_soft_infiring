<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $note;

    public function __construct($note)
    {
        $this->note = $note;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_notification',
            with: [
                'noteTitle' => $this->note->title,
                'noteContent' => $this->note->content,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
