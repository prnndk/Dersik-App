@extends('dashboard.layouts.main')
@section('container')
<div class="card">
    <div class="card-header">
        <h3>Form Registrasi Promnight dersik 22</h3>
      </div>
      <div class="card-body">
        <p>{{ $detail->nama }} s</p>
        <p>{{ $detail->email }}</p>
        <p>{{ $detail->no_hp }}</p>
    </div>
</div>
@endsection