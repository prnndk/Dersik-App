@extends('dashboard.layouts.main')
@section('webtitle','Blast Email')
@section('container')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Blast Email</h1>
</div>
<livewire:mailblast/>
@endsection