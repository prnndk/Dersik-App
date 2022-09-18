@extends('dashboard.layouts.main')
@section('webtitle','e-Voting App')
@section('container')
    <div class="card">
        <div class="card-header justify-content-center">
            <h2>Masuk Gunakan Token Anda</h2>
        </div>
        <div class="col-md-6">
        <a href="{{ route('usertoken') }}" class="badge badge-info text-decoration-none"><i class="fas fa-user"></i> Lihat Daftar token anda</a>
        </div>
        <form action="{{ route('cekToken') }}" role="form" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="token">Token</label>
                    <input type="text" class="form-control @error('token') is-invalid @enderror" id="token" name="token"  required value="{{ old('token') }}">
                    @error('token')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit Token</button>
            </div>
        </form>
        <div class="card-header"><h4>Hasil Perhitungan Pemilihan terkini</h4></div>
        <div class="card-body">
            <div class="row">
                @foreach ($vote as $vte)
                <div class="col-md-4">
                    <h5>{{ $vte->nama }}</h5>
                    <a href="/vote/qc/{{ $vte->link }}" class="btn btn-primary"><i class="fas fa-chart-simple"></i> Hasil terkini</a>
                </div>
                @endforeach    
            </div>
        </div>
    </div>
    @endsection
    
