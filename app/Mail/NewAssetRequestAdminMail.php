<?php

namespace App\Mail;

use App\Models\AssetRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAssetRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $assetRequest; 

    /**
     * Create a new message instance.
     */
    public function __construct(AssetRequest $assetRequest)
    {
        $this->assetRequest = $assetRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[SILKOM] Pengajuan Alat Baru Diterima',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.asset-requests.admin-new',
            with: [
                'assetRequest' => $this->assetRequest,
            ],
        );
    }
}