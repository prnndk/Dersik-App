@extends('dashboard.layouts.main')
@section('webtitle','Detail User '.$data->username)
@section('container')
<div class="section-header">
    <h2>Detail User</h2>
    <div class="section-header-breadcrumb">
        <a href="{{ route('userlist.index') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-arrow-left"></i> Back To Index</a>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">Nama Lengkap: {{ $data->name }}</li>
                        <li class="list-group-item">Username: {{ $data->username }}</li>
                        <li class="list-group-item">Email: {{ $data->email }}</li>
                        <li class="list-group-item">Kelas dan Angkatan: {{ $data->kelas->kelas}}/ {{ $data->kelas->angkatan->nama }}</li>
                        <li class="list-group-item">TTL: {{ $data->Regency->name}}, {{ $data->dob }}</li>
                    </ul>
                </div>
            {{-- End Row --}}
            </div>
        </div>
    </div>
@endsection
