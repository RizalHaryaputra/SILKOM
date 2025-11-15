<?php

namespace App\Mail;

use App\Models\Borrowing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBorrowingRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $borrowing; // <-- BUAT PUBLIC PROPERTY

    /**
     * Create a new message instance.
     */
    public function __construct(Borrowing $borrowing) // <-- TERIMA DATA
    {
        $this->borrowing = $borrowing;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[SILKOM] Permintaan Peminjaman Aset Baru',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // Tautkan ke file view Blade
            markdown: 'emails.borrowing.admin-new-request',
            // Kirim data 'borrowing' ke view
            with: [
                'borrowing' => $this->borrowing,
            ],
        );
    }
}