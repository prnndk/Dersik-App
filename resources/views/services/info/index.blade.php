@extends('dashboard.layouts.main')
@section('webtitle','Informasi')
@section('container')
<div class="section-header"><h3>Pengumuman</h3>
@if (auth()->user()->role == 'admin')
<div class="section-header-breadcrumb">
    <a href="{{ route('informasi.create') }}" class="badge badge-primary text-decoration-none mr-1"><i class="fas fa-plus"></i> Create New Informasi</a>
    <a href="{{ route('makeKateginfo') }}" class="badge badge-info text-decoration-none ml-1"><i class="fas fa-plus"></i> Create New Kategori</a>
</div>
@endif
</div>
<div class="row">
@foreach ($info as $in)
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{$in->judul}}</h4>
            <div class="card-header-action">
                <span class="badge badge-info">{{$in->kateginfo->name}}</span>
            </div>
            </div>
                <img src="{{ asset('storage/'.$in->img) }}" class="mx-auto rounded" height="150" width="300" alt="{{ $in->judul }}">
                <div class="card-body">
                    {!! $in->body !!}
                </div>
        </div>
    </div>
@endforeach
</div>

@endsection
