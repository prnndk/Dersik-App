<x-mail::message>

# Terjadi update pada pendataanmu

Dari perubahan yang telah dilakukan, terdapat perubahan. Cek pada tombol di bawah ini.

<x-mail::button :url="$link">
Cek Pendataanmu
</x-mail::button>

* Status pendataan anda : @if ($status==0) Dalam Peninjauan @elseif ($status==1) Disetujui @else Ditolak @endif

@if ($status==2 )
* Pesan : {{ $message }}.
@endif

Terimakasih, With 💙 DERSIK SMASA 22

{{ config('app.name') }}

</x-mail::message>
