<x-mail::message>
# Halo Admin,

Ada permintaan peminjaman baru yang perlu Anda tinjau.

**Detail Permintaan:**
* **Peminjam:** {{ $borrowing->user->name }}
* **Aset:** {{ $borrowing->asset->name }}
* **Tujuan:** {{ $borrowing->purpose }}
* **Tanggal Pinjam:** {{ $borrowing->borrowed_at->format('d M Y') }}

Silakan login ke dashboard Anda untuk menyetujui atau menolak permintaan ini.

<x-mail::button :url="route('admin.borrow.requests.index')">
Tinjau Permintaan
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>