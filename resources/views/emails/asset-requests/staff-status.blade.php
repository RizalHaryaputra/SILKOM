<x-mail::message>
# Halo, {{ $assetRequest->requester_user->name }}

Pengajuan alat baru Anda telah diperbarui.

**Nama Alat:** {{ $assetRequest->asset_name }}
**Status Baru:** **{{ $assetRequest->status }}**

@if($assetRequest->status == 'Approved')
Pengajuan Anda telah disetujui oleh Admin.
@elseif($assetRequest->status == 'Rejected')
Pengajuan Anda ditolak. Silakan hubungi Admin Lab untuk informasi lebih lanjut.
@endif

<x-mail::button :url="route('staff.asset-requests.index')">
Lihat Riwayat Pengajuan Saya
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>