@extends('dashboard.layouts.main')
@section('webtitle','List Token User')
@section('container')
<div class="card">
    <div class="card-header">
        <h4>List Token user {{ auth()->user()->name }}</h4>
        <div class="card-header-action">
            <a href="{{ route('vote') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-arrow-left"></i> Back To Vote</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($userToken as $data)
            <div class="col-md-4">
                <h5 class="fw-bold">{{ $data->token }}</h5>
                <p>{{ $data->vote->nama }}</p>
                <p>Valid from: <br>{{ $data->vote->mulai_coblos }} - {{ $data->vote->akhir_coblos }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection