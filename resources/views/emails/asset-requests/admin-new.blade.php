<x-mail::message>
# Halo Admin,

Ada pengajuan alat baru yang perlu Anda tinjau.

**Detail Pengajuan:**
* **Pemohon:** {{ $assetRequest->requester_user->name }}
* **Nama Alat:** {{ $assetRequest->asset_name }}
* **Spesifikasi:** {{ $assetRequest->specifications ?? '-' }}
* **Alasan:** {{ $assetRequest->reason }}

Silakan login ke dashboard Anda untuk menyetujui atau menolak pengajuan ini.

<x-mail::button :url="route('admin.asset-requests.index')">
Tinjau Pengajuan
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>