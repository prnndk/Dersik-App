@extends('dashboard.layouts.main')
@section('webtitle','Dashboard Korwil')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>Data Korwil Dersik 22</h4>
            <div class="card-header-action">
                <button class="btn btn-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Korwil</button>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($korwil as $koor)
        <div class="col-md-4">
            <div class="card card-danger">
                <div class="card-header">
                    <h4>{{ $koor->PJ }}</h4>
                    <div class="card-header-action">
                        <span class="badge badge-info">{{ $koor->kota->name }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Phone Number: +62{{ $koor->number }}</li>
                        <li>Instagram/line/telegram: {{ $koor->kontaklain }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
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
