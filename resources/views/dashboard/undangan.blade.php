@extends('dashboard.layouts.main')
@section('webtitle','Undangan')
@section('container')
<div class="card">

    <div class="card-body">
        @foreach ($dataundangan as $undangan )
        @foreach ($info as $i )

        @if ($undangan->statusbayar != 'Lunas')
        <h2 class="text-danger">Harap Selesaikan Pembayaran!</h2>
        @else
        <h4 class="text-center mb-3">Undangan Untuk {{ $undangan->User->username }}</h4>
        <div class="row">
            <div class="col-md-8">
                <h6>Halo Sobat dersik, berikut kami sampaikan detail undangan Promnight Dersik 2022 :</h6>
                <p>Nama: {{ $undangan->nama }}</p>
                <p>Kelas: {{ $undangan->kelas->kelas}}</p>
                <p>Nomor Telepon: 0{{ $undangan->no_hp }}</p>
                <p>Open Gate: {{ $i->open_gate }}</p>
                <p>Tempat: {{ $i->tempat }}</p>
                <h6 class="text-justify">Diinformasikan untuk para sobat Dersik untuk datang tepat waktu sesuai dengan jadwal open gate diatas. Apabila terlambat konsekuensinya tidak mendapat polaroid, karena polaroid hanya tersedia pada masa open gate </h6>
            </div>
            <div class="col-md-3">
                <h5 class="section-title"> Scan this QR Code for Check-in</h5>
                <div class="d-flex justify-content-center">
                    {!! QrCode::size(200)->generate($undangan->qr_code); !!}
                </div>
                <br>
                <a href="/user/pdf/{{ $undangan->id }}.pdf" class="btn btn-primary d-flex justify-content-center">Download PDF</a>
            </div>
        </div>

        @endif
    </div>
</div>
@endforeach
        @endforeach
@endsection
