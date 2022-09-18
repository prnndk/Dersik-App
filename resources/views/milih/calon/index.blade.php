@extends('dashboard.layouts.main')
@section('webtitle','Data Calon e-Voting')
@section('container')
    <div class="section-header"><h2>Daftar Calon Pemilihan</h2>
    <div class="section-header-breadcrumb">
        @if(auth()->user()->role=='User')
            {{\Carbon\Carbon::now()}}
        @else
      <a href="/dashboard/ketua/create" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Tambah Ketua</a>
        @endif
    </div>
    </div>
    <div class="card">
        <div class="card-body">
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($calon as $ketua )
                <div class="card col-md-3">
                  <img src="{{ asset('storage/'.$ketua->img) }}" class="mx-auto d-block rounded" width="200" height="300" alt="{{ $ketua->nama }}">
                  <div class="card-body">
                    <h5 class="card-title">{{ $ketua->nama }}</h5>
                    <div class="row">
                      <div class="col-md-6">
                        <p class="font-italic">{{ $ketua->panggilan }}</p>
                      </div>
                      <div class="col-md-6">
                        <a href="/dashboard/ketua/{{$ketua->id}}" class="btn btn-primary">Detail</a>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
