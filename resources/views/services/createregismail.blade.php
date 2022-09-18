@extends('dashboard.layouts.main')
@section('webtitle','Buat Permohonan Email')
@section('container')
<div class="card">
    <div class="card-header"><h3>Registrasi email domain smasa.id</h3></div>
    <div class="card-body">
        <form method='POST' role="form" action="/dashboard/regis-mail">
            @csrf
            @if(auth()->user()->role=='admin')
                <div class="form-group col-md-6">
                    <label for="nama">Nama Lengkap</label>
                     <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="username">Username</label>
                     <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  required value="{{ old('username') }}">
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            @else
            <div class="form-group col-md-6">
                <label for="nama">Nama Lengkap</label>
                {{-- <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}"> --}}
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  readonly value="{{ Auth::user()->name }}">
                @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="username">Username</label>
                {{-- <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  required value="{{ old('username') }}"> --}}
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  readonly value="{{ Auth::user()->username }}">
                @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            @endif
            <div class="row">

              <div class="form-group col-md-3">
                <label for="email">Username email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
                </div>
              <div class="form-group col-md-3">
                <label for='domain_id'>Pilih Domain Anda</label>
                <select class="form-control selectric @error('domain_id') is-invalid @enderror" id="domain_id" name='domain_id' required>
                  <option value="" selected disabled>-Pilih Domain-</option>
                    @foreach ($domain as $list)
                    @if (old('domain_id')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->name }}</option>
                    @else
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('domain_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              </div>
              <div class="col-6"> <button type="submit" class="btn btn-primary">Submit Form</button></div>

        </form>
      </div>
    </div>
@endsection
