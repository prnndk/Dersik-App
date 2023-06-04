@extends('dashboard.layouts.main')
@section('container')
{{-- Put Content Here --}}
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h2>Promnight Registration</h2>
</div>
{{--  Body Card Start  --}}
    <div class="card">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card-header">
                    <h4>Registrasi</h4>
                </div>
                <div class="card-body">
                <livewire:register-prom/>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card-header">
                    <h4>Informasi Terkini</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
