@extends('dashboard.layouts.main')
@section('webtitle','Tambahkan Domain')
@section('container')
    <div class="section-header"><h3>Tambah data domain</h3></div>
<div class="card">
    <div class="card-body">
        {{-- start form --}}
        <form method='POST' role="form" action="/dashboard/domain">
            @csrf
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="name">Nama Domain</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required autofocus value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email Admin Domain</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="name" name="email"  required value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="pj">Penanggung Jawab Domain</label>
                    <input type="text" class="form-control @error('pj') is-invalid @enderror" id="name" name="pj"  required value="{{ old('pj') }}">
                    @error('pj')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- select angkatan --}}
                <div class="form-group col-md-6">
                <label for='angkatan_id'>Pilih Angkatan</label>
                <select class="form-control selectric" name='angkatan_id'>
                    @foreach ($angkatan as $list)
                    @if (old('angkatan_id')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                    @else
                        <option value="{{ $list->id }}">{{ $list->nama }}</option>
                        @endif
                    @endforeach
                </select>
                </div>
            {{-- end row --}}
            </div>
              <div class="col-6"> <button type="submit" class="btn btn-primary">Submit Form</button></div>

        </form>
    </div>
</div>

@endsection
