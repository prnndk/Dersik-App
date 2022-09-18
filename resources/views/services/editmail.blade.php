@extends('dashboard.layouts.main')
@section('webtitle','Edit Permohonan Email')
@section('container')
<div class="section-header"><h3>Edit Permohonan Email</h3></div>
<div class="card">
    <div class="card-body">
        @foreach ($email as $e )
        <form method='POST' role="form" action="/dashboard/regis-mail/{{ $e->id }}">
            @method('put')
            @csrf
    <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  readonly value="{{ $e->nama }}">
                    @error('nama')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  readonly value="{{ $e->username }}">
                    @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email">Username email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email',$e->email) }}">
                        @error('email')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for='domain_id'>Pilih Domain Anda</label>
                        <select class="form-control selectric" name='domain_id'>
                            @foreach ($domain as $list)
                            @if (old('domain_id',$e->domain_id)==$list->id)
                            <option value="{{ $list->id }}" selected>{{ $list->name }}</option>
                            @else
                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                            @endif
                            @endforeach
                          </select>
                      </div>
                  </div>
            </div>
            {{-- batas --}}
            <div class="col-md-6">
                @if (auth()->user()->role =="admin")
                    <div class="card-header"><h4>Menu Admin</h4></div>
                    <div class="form-group">
                        <label for='status'>Status Email</label>
                        <select class="form-control selectric" name='status'>
                            <option value="{{ $e->status }}" disabled selected>-{{ $e->status }}-</option>
                            <option value="Dalam Peninjauan">Dalam Peninjauan</option>
                            <option value="Terverifikasi">Terverifikasi</option>
                            <option value="Ditolak">Ditolak</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="password">Email password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password',$e->password) }}">
                        @error('password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="alasan">Alasan Penolakan</label>
                        <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" value="{{ old('alasan',$e->alasan) }}">
                        @error('alasan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                @endif
            </div>
        </div>
        <a href="/dashboard/regis-mail" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Back To Index</a>
        <button type="submit" class="btn btn-primary">Edit Permohonan</button>
        </form>
        @endforeach
    </div>
</div>
@endsection
