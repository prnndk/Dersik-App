@extends('dashboard.layouts.main')
@section('container')
{{-- Put Content Here --}}
<div class="section-header">
    <h1>Dashboard</h1>
</div>
<div class="card">
    <div class="card-header"><h4>Form Registrasi Promnight</h4></div>
    <div class="card-body">
        <form method='POST' role="form" action="/dashboard/formprom">
            @csrf
            <div class="form-group col-6">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
                {{-- <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  readonly value="{{ Auth::user()->name }}"> --}}
                @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="email">Active Mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email') }}">
                {{-- <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  readonly value="{{ Auth::user()->email }}"> --}}
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for='kelas'>Kelas</label>
                <select class="form-control selectric" name='kelas_id'>
                    @foreach ($kelas as $list)
                    @if (old('kelas_id')==$list->id)
                    <option value="{{ $list->id }}" selected>{{ $list->kelas }}</option>
                    @else
                    <option value="{{ $list->id }}">{{ $list->kelas }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="no_hp">Nomor Hp Aktif</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" required value="{{old('no_hp') }}">
                @error('no_hp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="kesediaan" class="d-block">Kesediaan mengikuti prom</label>
                <div class="form-check">
                  <input class="form-check-input @error('kesediaan') is-invalid @enderror" type="radio" name="kesediaan" value="Ikut" id="kesediaan" {{ old('kesediaan')=='Ikut' ? 'checked':''}}>
                  <label class="form-check-label" for="iya">
                    Mengikuti Prom
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input @error('kesediaan') is-invalid @enderror" type="radio" name="kesediaan" value="Tidak Ikut" id="kesediaan" {{ old('kesediaan')=="Tidak Ikut" ? 'checked':'' }}>
                  <label class="form-check-label" for="Tidak">
                   Tidak Mengikuti Prom
                  </label>
                </div>
                @error('kesediaan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="kedinasan" class="d-block">Apakah anda mengikuti kedinasan?</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="kedinasan" value="Ikut" id="kedinasan" {{ old('kedinasan')=='Ikut' ? 'checked':''}}>
                  <label class="form-check-label" for="iya">
                    Mengikuti Kedinasan
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="kedinasan" value="Tidak" id="kedinasan" {{ old('kedinasan')=='Tidak' ? 'checked':'' }}>
                  <label class="form-check-label" for="Tidak">
                   Tidak Mengikuti Kedinasan
                  </label>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Ujian Kedinasan</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal"value="{{ old('tanggal') }}">
                    @error('tanggal')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
              <button type="submit" class="btn btn-primary">Submit Form</button>
        </form>
      </div>
    </div>
    
@endsection