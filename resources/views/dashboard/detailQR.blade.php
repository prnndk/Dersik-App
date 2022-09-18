@extends('dashboard.layouts.main')
@section('webtitle','Detail')
@section('container')
    <div class="card">
        <div class="card-header"><h3>Detail User {{ $datauser->User->username}}</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <img src="/user/image/{{ $datauser->id }}.jpg" class="rounded" width="200" height="300" alt="">
                </div>
                <div class="col-lg-8">
                    <p>Nama: {{ $datauser->nama }}</p>
                    <p>Kelas: {{ $datauser->kelas->kelas }}</p>
                    <p>Email: {{ $datauser->email }}</p>
                    <p>Nomor Telepon: 0{{ $datauser->no_hp }}</p>
                    <p>Ikut Prom: {{ $datauser->kesediaan }}</p>
                    <p>Status pembayaran: </p> @if ($datauser->statusbayar =='Lunas')
                        <h5 class="text-success">LUNAS</h5>
                    @else
                        <h5 class="text-danger">BELUM BAYAR</h5>
                    @endif
                    <a href="/dashboard/scan" class="btn btn-info">SCAN ANOTHER DATA</a>
                </div>
            </div>
        </div>
    </div>
@endsection
