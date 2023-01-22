@extends('dashboard.layouts.main')
@section('webtitle','View Pendataan')
@section('container')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pendataan.index') }}" class="btn btn-icon-sm "><i class="fas fa-arrow-left"></i></a>
            <h4>Form isian pendataan {{ $data->nama }}</h4>
            <div class="card-header-action">
                <span class="badge badge-primary">{{ $data->angkat->nama }}</span>
                @if($data->pengajuan==0)<span class="badge badge-info">Pengajuan baru</span>@elseif($data->pengajuan==1) <span class="badge badge-info">Pengajuan ulang</span> @endif
                <a href="{{ route('pendataan.edit',$data->id) }}" class="btn btn-icon btn-warning "><i class="fas fa-pencil"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group mb-2">
                        <li class="list-group-item">Nama: {{ $data->nama }}</li>
                        <li class="list-group-item">Email: {{ $data->email }}</li>
                        <li class="list-group-item">Kelas: {{ $data->kls->kelas }}</li>
                        <li class="list-group-item">Status: {{ $data->sttus->nama }}</li>
                        <li class="list-group-item">Tempat Status: {{ $data->instansi }}</li>
                        <li class="list-group-item">Detail Status: {{ $data->detail_status }}</li>
                        <li class="list-group-item">Kota Domisili: {{ $data->kab->name }}</li>
                        <li class="list-group-item">Nomor Hp: +62{{ $data->nomor }}</li>
                        <li class="list-group-item">Teman Satu Domisili: <span class="fw-bold">{{ $data->teman_smasa }}</span> @if($data->banyak_teman) Banyaknya: {{ $data->banyak_teman }} @endif</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group mb-2">
                        <li class="list-group-item">Status data: @if($data->review==0)<span class="badge badge-warning">On Review</span>@elseif ($data->review==1)<span class="badge badge-success">Accepted</span>@elseif($data->review==2)<span class="badge badge-danger">Rejected</span>@endif</li>
                        @if($data->review==2)
                        <li class="list-group-item">Alasan ditolak: {{ $data->message }}</li>
                        @endif
                        @if(auth()->user()->role=='admin')
                        <li class="list-group-item">IP Address: <span class="badge badge-primary">{{ $data->ip }}</span></li>
                        @if($data->user_id)
                        <li class="list-group-item">User Identification: {{ $data->user->name}}</li>
                        @elseif(!$data->user_id)
                        <li class="list-group-item">Submitted Public</li>
                        @endif
                        <li class="list-group-item">{!! QrCode::size(150)->generate($data->url) !!}</li>
                        @endif
                    </ul>
                    <a href="https://wa.me/62{{ $data->nomor }}" class="btn btn-icon-sm btn-success"><i class="fas fa-phone"></i></a>
                    <a href="mailto:{{ $data->email }}" class="btn btn-icon-sm btn-info"><i class="fas fa-envelope-open"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection