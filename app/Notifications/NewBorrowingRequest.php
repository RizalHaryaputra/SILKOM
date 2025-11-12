<?php

namespace App\Notifications;

use App\Models\Borrowing; // <-- Impor model
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBorrowingRequest extends Notification implements ShouldQueue // Gunakan antrian agar tidak lambat
{
    use Queueable;

    protected $borrowing;

    public function __construct(Borrowing $borrowing)
    {
        $this->borrowing = $borrowing;
    }

    public function via($notifiable): array
    {
        return ['mail']; // Kirim via email
    }

    public function toMail($notifiable): MailMessage
    {
        $studentName = $this->borrowing->user->name;
        $assetName = $this->borrowing->asset->name;
        $borrowDate = $this->borrowing->borrowed_at->format('d M Y');
        
        $approvalUrl = route('admin.dashboard');

        return (new MailMessage)
                    ->subject('Permintaan Peminjaman Aset Baru')
                    ->line("Halo Admin,")
                    ->line("Ada permintaan peminjaman baru dari $studentName.")
                    ->line("Aset: **$assetName**")
                    ->line("Tanggal Pinjam: **$borrowDate**")
                    ->line("Status saat ini: Pending")
                    ->action('Lihat Dashboard Persetujuan', $approvalUrl)
                    ->line('Harap segera ditinjau.');
    }
}