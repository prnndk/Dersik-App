@extends('dashboard.layouts.main')
@section('webtitle','Detail Kelas '.$kelas->kelas)
@section('container')
<div class="card">
    <div class="card-header">
        <h4>Detail Data</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/'.$kelas->fotbar) }}" class="rounded img-fluid" width="600" height="400" alt="">
            </div>
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item">ANGKATAN: {{ $kelas->angkatan->nama }}</li>
                    <li class="list-group-item">KELAS: {{ $kelas->kelas }}</li>
                    <li class="list-group-item">NAMA: {{ $kelas->nama }}</li>
                    <li class="list-group-item">INSTAGRAM: {{ $kelas->instagram }}</li>
                    <li class="list-group-item">JUMLAH:{{$kelas->jumlah}}</li>
                </ul>
                <a href="/dashboard/kelas" class="btn btn-info">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
