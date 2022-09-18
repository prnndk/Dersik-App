@extends('dashboard.layouts.main')
@section('webtitle','Tambah Data Calon')
@section('container')
    <div class="section-header"><h3>Tambahkan data ketua</h3></div>
<div class="card">
<div class="card-body">
    <form method="POST" action="/dashboard/dataketua" role="form">
                @csrf
            <div class="row">
                {{-- select ketua --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Pilih Ketua</label>
                <select class="form-control selectric" required name='ketua_id'>
                    <option value="" selected disabled>-Pilih Ketua-</option>
                    @foreach ($ketua as $list)
                    @if (old('ketua_id')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                    @else
                        <option value="{{ $list->id }}">{{ $list->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
                {{-- select kelas --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Kelas</label>
                <select class="form-control selectric" required name='kelas'>
                        <option value="" selected disabled>-Pilih Kelas-</option>
                        @foreach ($kelas as $list)
                        @if (old('kelas')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->kelas }}</option>
                        @else
                        <option value="{{ $list->id }}">{{ $list->kelas }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
            {{-- select kota lahir --}}
            <div class="form-group col-md-6">
                <label for='tempatlahir'>Kota/ Kab Lahir</label>
                <select class="form-control select2" required name='tempatlahir'>
                        <option value="" selected disabled>-Pilih Tempat Lahir-</option>
                        @foreach ($kab as $list)
                        @if (old('tempatlahir')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->name }}</option>
                        @else
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
            {{-- dob --}}
            <div class="form-group col-md-6">
                <label for="dob">Tanggal Lahir</label>
                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dob"value="{{ old('dob') }}">
                @error('dob')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
            </div>
            {{-- instagram --}}
            <div class="form-group col-md-6">
                <label for="ig">Instagram Account</label>
                <input type="text" class="form-control @error('ig') is-invalid @enderror" id="ig" name="ig"  required value="{{ old('ig') }}">
                @error('ig')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- end row --}}
            <div class="col-md-12 mb-3">
                <label for="pengalaman" class="form-label">Pengalaman Organisasi</label>
                @error('pengalaman')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
                <input id="pengalaman" type="hidden" name="pengalaman" value="{{ old('pengalaman') }}">
                <trix-editor input="pengalaman"></trix-editor>
            </div>
        </div>
            {{-- end form --}}
            <button type="submit" class="btn btn-primary">Submit Form</button>
    </form>
    </div>
</div>
<script>
   document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
   })
</script>
@endsection
