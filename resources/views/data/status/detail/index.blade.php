@extends('dashboard.layouts.main')
@section('webtitle','Data Detail Status')
@section('container')
<div class="section-header">
    <h2>Data Status</h2>
<div class="section-header-breadcrumb">
    {{-- <a href="" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Buat Data Status</a> --}}
    <button class="btn btn-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Status</button>
</div>
</div>

<div class="card">
<div class="card-body">
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">Detail Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->id }}</td>
                <td>{{ $d->nama }}</td>
                <td>
                <button class="badge badge-warning mt-1 border-0" data-bs-toggle="modal" data-bs-target="#edit"><i class="far fa-edit"></i></button>
                <button class="badge badge-danger mt-1 border-0" data-bs-toggle="modal" data-bs-target="#delete"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
@section('bawahsection')
{{-- Tambah MODAL --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Detail Status</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ route('detail-status.store') }}" role="form" method="post">
        @csrf
        <div class="form-group">
            <label for='id_detail'>Pilih Instansi</label>
            <select class="form-control selectric" name='id_detail'>
                @foreach ($statusd as $detail)
                    <option value="" selected disabled>-Pilih Instansi-</option>
                @if (old('id_detail')==$detail->id)
                    <option value="{{ $detail->id }}" selected>{{ $detail->nama }}</option>
                @else
                    <option value="{{ $detail->id }}">{{ $detail->nama }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nama">Nama Status</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="submit" class="btn btn-primary">Tambahkan Data</button>
    </div>
        </form>
    </div>
    </div>
</div>
@endsection
