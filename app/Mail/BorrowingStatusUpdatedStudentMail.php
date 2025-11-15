<?php

namespace App\Mail;

use App\Models\Borrowing; // <-- IMPORT
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // <-- IMPLEMENTS
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowingStatusUpdatedStudentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $borrowing;

    /**
     * Create a new message instance.
     */
    public function __construct(Borrowing $borrowing)
    {
        $this->borrowing = $borrowing;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Subjek email akan dinamis
        return new Envelope(
            subject: '[SILKOM] Status Peminjaman Anda: ' . $this->borrowing->status,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.borrowing.student-status-update',
            with: [
                'borrowing' => $this->borrowing,
            ],
        );
    }
}