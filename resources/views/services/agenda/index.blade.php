@extends('dashboard.layouts.main')
@section('webtitle','Agenda')
@section('container')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Agenda</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('agenda.create') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Create New Agenda</a>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <h4>Table List of Agenda</h4>
            </div>
            <table class="table table-responsive-sm" id="table">
                <thead>
                <tr>

                </tr>
                </thead>
                <tbody>
                @foreach ($agendas as $agenda )

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
