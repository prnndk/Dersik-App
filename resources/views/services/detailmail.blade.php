@extends('dashboard.layouts.main')
@section('webtitle','Detail Permohonan Email')
@section('container')
    <div class="section-header"><h3>Detail Permohonan Email</h3></div>
    <div class="card">
        <div class="card-body">
            @foreach ($email as $show )
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group mb-2">
                <div class="card-header"><h4>Data Permohonan Email</h4></div>
                <li class="list-group-item">Nama Pemohon: {{ $show->nama }}</li>
                <li class="list-group-item">Username: {{ $show->username }}</li>
                <li class="list-group-item">Requested Mail: {{ $show->email .'@'. $show->domain->name }}</li>
                @if ($show->status == "Dalam Peninjauan")
                <li class="list-group-item">Status Permohonan: <span class="badge badge-info">{{ $show->status }}</span></li>
                @elseif ($show->status =="Ditolak")
                <li class="list-group-item">Status Permohonan: Mohon maaf permohonan anda <strong class="badge badge-danger">{{ $show->status }}</strong></li>
                @else
                <li class="list-group-item">Status Permohonan: <span class="badge badge-success">{{ $show->status }}</span></li>
                @endif
            </ul>
        </div>
        @if ($show->status =="Ditolak")
        <div class="col-md-6">
            <ul class="list-group mb-2">
                <div class="card-header"><h4>Permohonan Anda Ditolak</h4></div>
                <li class="list-group-item">Alasan ditolak: <i>{{ $show->alasan }}</i></li>
                <li class="list-group-item">Jika ini adalah kesalahan hubungi <a href="mailto:dev@smasa.id">email ini</a></li>
            </ul>
        </div>
        @endif
        @if ($show->status == "Terverifikasi")
        <div class="col-md-6">
            <ul class="list-group mb-2">
                <div class="card-header"><h4>Kredensial Email</h4></div>
                <li class="list-group-item">Akses Email: <a href="https://mail.smasa.id">https://mail.smasa.id</a></li>
                <li class="list-group-item">Username: {{ $show->email .'@'. $show->domain->name }}</li>
                <li class="list-group-item">Password: <strong>{{ $show->password }}</strong></li>
                <li class="list-group-item">Jika ada kendala anda dapat hubungi <a href="mailto:dev@smasa.id">disini</a></li>
            </ul>
        </div>
        </div>
        @endif
        @endforeach
        </div>
    </div>
@endsection
