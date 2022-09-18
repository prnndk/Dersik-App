@extends('dashboard.layouts.main')
@section('webtitle','Data Status')
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
                <th scope="col">ID Status</th>
                <th scope="col">Detail Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instansi as $si)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $si->id }}</td>
                <td>{{ $si->id_status }}/ <span class="fw-bold">{{ $si->status->nama }}</span></td>
                <td>{{ $si->nama }}</td>
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
<div class="modal fade modaltambah" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Detail Status</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ route('instansi.store') }}" role="form" method="post">
        @csrf
        <div class="form-group">
            <label for='id_status'>Pilih Status</label>
            <select class="form-control selectric" name='id_status'>
                <option value="" disabled selected>-Pilih Status-</option>
                @foreach ($status as $s)
                @if (old('id_status')==$s->id)
                <option value="{{ $s->id }}" selected>{{ $s->nama }}</option>
                @endif
                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nama">Nama Instansi</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="singkatan">Singkatan Instansi</label>
            <input type="text" class="form-control @error('singkatan') is-invalid @enderror" id="singkatan" name="singkatan"  required value="{{ old('singkatan') }}">
            @error('singkatan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for='tempat'>Pilih Tempat Instansi</label>
            <select class="form-control select2" name='tempat' id="tempat">
                <option value="" disabled selected>-Pilih Tempat Instansi-</option>
                @foreach ($kota as $kab)
                @if (old('tempat')==$kab->id)
                <option value="{{ $kab->id }}" selected>{{ $kab->name }}</option>
                @endif
                <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan Data</button>
    </form>
    </div>
    </div>
    </div>
</div>
@section('cusctomjs')
    <script>
        $(document).ready(function() {
            $("#tempat").select2({
                dropdownParent: $(".modaltambah .modal-content")
            });
        });
    </script>
@endsection
@endsection
