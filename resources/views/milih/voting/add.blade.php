@extends('dashboard.layouts.main')
@section('webtitle','Tambah Pemilihan')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>Buat Voting Baru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('voting.store')}}" role="form">
                @csrf
{{--                Nama Voting--}}
                <div class="form-group col-md-6">
                    <label for="nama">Nama Pemilihan</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
{{--                Link Voting--}}
                <div class="form-group col-md-6">
                    <label for="link">Link Voting</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" required value="{{old('link')}}">
                    @error('link')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
{{--                select angkatan--}}
                <div class="form-group col-md-6">
                    <label for='angkatan_id'>Pilih Angkatan</label>
                    <select class="form-control selectric" required name='angkatan_id'>
                        <option value="" selected disabled>-Pilih Angkatan-</option>
                        @foreach ($angkatan as $list)
                            @if (old('angkatan_id')==$list->id)
                                <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                            @else
                                <option value="{{ $list->id }}">{{ $list->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
{{--                tanggal mulai coblos--}}
                <div class="form-group col-md-6">
                    <label for="mulai_coblos">Tanggal Mulai Voting</label>
                    <input type="datetime-local" class="form-control @error('mulai_coblos') is-invalid @enderror" id="mulai_coblos" name="mulai_coblos" required value="{{old('mulai_coblos')}}">
                    @error('mulai_coblos')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
{{--                tanggal akhir coblos--}}
                <div class="form-group col-md-6">
                    <label for="akhir_coblos">Tanggal Akhir Voting</label>
                    <input type="datetime-local" class="form-control @error('akhir_coblos') is-invalid @enderror" id="akhir_coblos" name="akhir_coblos" required value="{{old('akhir_coblos')}}">
                    @error('akhir_coblos')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                {{-- end form --}}
                <button type="submit" class="btn btn-primary">Submit Form</button>
            </form>
        </div>
    </div>
@endsection
