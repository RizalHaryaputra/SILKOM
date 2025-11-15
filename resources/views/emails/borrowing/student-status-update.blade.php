<x-mail::message>
# Halo, {{ $borrowing->user->name }}

Permintaan peminjaman Anda telah diperbarui.

**Aset:** {{ $borrowing->asset->name }}
**Status Baru:** **{{ $borrowing->status }}**

@if($borrowing->status == 'Approved')
Silakan ambil aset di laboratorium sesuai tanggal peminjaman.
@elseif($borrowing->status == 'Rejected')
Permintaan Anda ditolak. Silakan hubungi Admin Lab untuk informasi lebih lanjut.
@endif

<x-mail::button :url="route('student.borrow.index')">
Lihat Riwayat Peminjaman Saya
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>