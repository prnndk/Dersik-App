@extends('dashboard.layouts.main')
@section('webtitle','Home')
@section('container')
<div class="section-header">
    <h1>Dashboard</h1>
</div>
@if (Auth::user()->role=='admin')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Registered User</h4>
          </div>
          <div class="card-body">
           {{$count = DB::table('users')->count()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-envelope"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pemohon Email</h4>
          </div>
          <div class="card-body">
            {{DB::table('regis_emails')->count()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Isi pendataan</h4>
          </div>
          <div class="card-body">
            {{ $siswa }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-people-group"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Data pemilih</h4>
          </div>
          <div class="card-body">
            {{ $voter }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Baris dua --}}
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-chalkboard-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Kelas terdata</h4>
          </div>
          <div class="card-body">
           {{$count = DB::table('kelas')->count()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-school"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Angkatan terdata</h4>
          </div>
          <div class="card-body">
            {{DB::table('angkatans')->count()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-info">
          <i class="far fa-file-word"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Korwil terdata</h4>
          </div>
          <div class="card-body">
            {{ DB::table('korwils')->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-info"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Informasi</h4>
          </div>
          <div class="card-body">
            {{ DB::table('informasis')->count() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
  <div class="section-body">
    <h2 class="section-title">Dersik SMASA 22 Pengumuman</h2>
    <p class="section-lead">Pengumuman terbaru DERSIK 2022</p>
  </div>
  
  {{-- card row --}}
  <div class="row">
    <div class="col-12 col-sm-12 col-lg-6 mt04">
      <div class="card card-info">
        <div class="card-header">
          @if (!$info)
          <h4>No Information</h4>
          @else
          <h4>{{ $info->judul }}</h4>
          <div class="card-header-action">
            <span class="badge badge-info text-decoration-none border-0">{{ $info->kateginfo->name }}</span>
            <span class="badge badge-warning text-decoration-none border-0">{{ $info->angkat->nama }}</span>
          </div>
        </div>
        <img src="{{ asset('storage/'.$info->img) }}" class="mx-auto rounded" height="150" width="300" alt="{{ $info->judul }}">
        <div class="card-body">
          {!! $info->body !!}
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-6 mt04">
      <div class="card">
        <div class="card-header">
          <h4>Quick Link</h4>
        </div>
      <div class="card-body">
        <div class="btn-group m-1">
          <a href="/dashboard/regis-mail" class="btn btn-primary">Regis Email</a>
        </div>
        <div class="btn-group m-1">
          <a href="/dashboard/ketua" class="btn btn-primary">Data Ketua</a>
        </div>
        <div class="btn-group m-1">
          <a href="/dashboard/angkatan" class="btn btn-primary">Data Angkatan</a>
        </div>
      </div>
    </div>
  </div>
@endsection
