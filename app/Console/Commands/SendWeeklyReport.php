<?php

namespace App\Console\Commands;

use App\Mail\WeeklyReportMail;
use App\Models\Borrowing;
use App\Models\Damage;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // <-- Facade PDF
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWeeklyReport extends Command
{
    protected $signature = 'report:send-weekly';
    protected $description = 'Generate dan kirim laporan PDF mingguan ke Pimpinan';

    public function handle()
    {
        $this->info('Menyiapkan data laporan mingguan...');

        // 1. Tentukan Rentang Waktu (Senin lalu - Minggu ini)
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate = Carbon::now()->subWeek()->endOfWeek();

        // 2. Ambil Data
        $damages = Damage::with(['asset', 'reporterAdmin'])
            ->whereBetween('reported_at', [$startDate, $endDate])
            ->get();

        $borrowings = Borrowing::with(['asset', 'user'])
            ->whereBetween('borrowed_at', [$startDate, $endDate])
            ->get();

        // 3. Hitung Ringkasan
        $data = [
            'startDate' => $startDate->format('d M Y'),
            'endDate' => $endDate->format('d M Y'),
            'damages' => $damages,
            'borrowings' => $borrowings,
            'totalDamages' => $damages->count(),
            'totalBorrowings' => $borrowings->count(),
            'totalCost' => $damages->sum('repair_cost'),
        ];

        // 4. Generate PDF (Render view ke string binary)
        $pdf = Pdf::loadView('reports.pdf.weekly_report', $data);
        $pdfContent = $pdf->output();

        // 5. Kirim ke Pimpinan
        $leaders = User::role('Lead')->get();

        if ($leaders->isEmpty()) {
            $this->error('Tidak ada user dengan role Pimpinan.');
            return;
        }

        $periodString = $startDate->format('d M') . ' - ' . $endDate->format('d M Y');
        
        foreach ($leaders as $leader) {
            Mail::to($leader->email)->send(new WeeklyReportMail($pdfContent, $periodString));
            $this->info("Laporan dikirim ke: {$leader->email}");
        }

        $this->info('Selesai!');
    }
}