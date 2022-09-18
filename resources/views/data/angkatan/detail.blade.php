@extends('dashboard.layouts.main')
@section('webtitle','Detail Angkatan '.$angkat->nama)
@section('container')
    <div class="card">
            <div class="card-header">
                <h4>Detail Angkatan</h4>
                <div class="card-header-action">
                    <a href="{{ route('angkatan.index') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-arrow-left"></i> Back To Angkatan List</a>
                    @if (auth()->user()->role=='admin')
                    <a href="/dashboard/angkatan/{{ $angkat->id }}/edit" class="badge badge-warning text-decoration-none"><i class="fas fa-pencil"></i> Edit this data</a>
                    @endif
                </div>
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    @if ($angkat->logo == null)
                    <img src="{{ asset('storage/app-image/dersik.png') }}" alt="" width="300" height="300">
                    @else
                    <img src="{{ asset('storage/'.$angkat->logo) }}" alt="" width="400" height="300">
                    @endif
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">NAMA ANGKATAN: {{ $angkat->nama}}</li>
                        <li class="list-group-item">Tahun: {{ $angkat->tahun }}</li>
                        <li class="list-group-item">Instagram: {{ $angkat->ig }}</li>
                        <li class="list-group-item">Email:  <a href="mailto:{{ $angkat->email }}" class="btn btn-outline-success btn-icon icon-left"><i class="fas fa-envelope"></i>{{ $angkat->email }}</a></li>
                        <li class="list-group-item">Nama Ketua: @if ($angkat->ketua == null)
                        <span class="badge badge-danger">Ketua Belum Tersedia</span>
                        @endif
                        {{ $angkat->ketua }}</li>
                        <li class="list-group-item">Filosofi: @if ($angkat->filosofi==null)<span class="badge badge-info">Filosofi angkatan {{ $angkat->nama }} tidak tersedia</span>
                        @endif
                            {!! $angkat->filosofi !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
