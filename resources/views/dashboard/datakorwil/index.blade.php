@extends('dashboard.layouts.main')
@section('webtitle','Dashboard Korwil')
@section('container')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
        <h1>Data Korwil Dersik 22</h1>
    <div class="section-header-breadcrumb">
        <button class="btn btn-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Korwil</button>
    </div>
</div>
<div class="section-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        @foreach ($grouped as $group )
        <div class="col-md-6">
            <h2 class="section-title">{{ $group->first()->kota->name }}</h2>
            <p class="section-lead">Data koordinator wilayah</p>
            <div class="row">
                @foreach ($group as $data )
                <div class="card card-info col-md-5 mx-2">
                    <div class="card-header">
                        <h4>{{ $data->PJ }}</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Nomor HP: {{ $data->number }}</li>
                            <li>Kontak Lain: {{ $data->kontaklain }}</li>
                            <li>Nama User: {{ $data->siswa->name }}</li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('bawahsection')
    {{-- Tambah MODAL --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="tambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Data Koordinator Wilayah</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('korwil.store') }}" role="form" method="post">
                        @csrf
                        <div class="form-group">
                            <label for='kota_id'>Pilih Wilayah (Kota/Kabupaten)</label>
                            <select class="form-control select2" name='kota_id' id="kota_id">
                                <option value="" disabled selected>-Pilih Wilayah-</option>
                                @foreach ($city as $s)
                                    @if (old('kota_id')==$s->id)
                                        <option value="{{ $s->id }}" selected>{{ $s->name }}</option>
                                    @endif
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="PJ">Nama Koordinator Wilayah</label>
                            <input type="text" class="form-control @error('PJ') is-invalid @enderror" id="PJ" name="PJ"  required value="{{ old('PJ') }}">
                            @error('PJ')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="number">Nomor Handphone</label>
                            <input type="number" class="form-control @error('number') is-invalid @enderror" id="number" name="number"  required value="{{ old('number') }}">
                            @error('number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kontaklain">Kontak lain (ig,line,telegram)</label>
                            <input type="text" class="form-control @error('kontaklain') is-invalid @enderror" id="kontaklain" name="kontaklain"  required value="{{ old('kontaklain') }}">
                            @error('kontaklain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for='siswa_id'>Pilih Nama User</label>
                            <select class="form-control select2" name='siswa_id' id="siswa_id">
                                <option value="" disabled selected>-Pilih Nama User-</option>
                                @foreach ($user as $usr)
                                    @if (old('siswa_id')==$usr->id)
                                        <option value="{{ $usr->id }}" selected>{{ $usr->name }}</option>
                                    @endif
                                    <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                @endforeach
                            </select>
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
@section('customjs')
    <script>
        $(document).ready(function() {
            $("#kota_id").select2({
                dropdownParent: $("#tambah"),
                minimumInputLength:3
            });
            $("#siswa_id").select2({
                dropdownParent: $("#tambah"),
                minimumInputLength:3
            });
        });
    </script>
@endsection
