<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment; // <-- Penting
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdfContent;
    protected $period;

    public function __construct($pdfContent, $period)
    {
        $this->pdfContent = $pdfContent;
        $this->period = $period;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[SILKOM] Laporan Mingguan: ' . $this->period,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reports.weekly',
            with: ['period' => $this->period],
        );
    }

    // Lampirkan PDF
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'Laporan-Mingguan.pdf')
                ->withMime('application/pdf'),
        ];
    }
}