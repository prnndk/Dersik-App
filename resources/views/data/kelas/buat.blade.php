@extends('dashboard.layouts.main')
@section('webtitle','Tambah Kelas')
@section('container')
<div class="section-header"><h3>Tambah Data Kelas</h3></div>
    <div class="card">
        <div class="card-body">
            <form action="/dashboard/kelas" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas"  required value="{{ old('kelas') }}">
                        @error('kelas')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Nama Kelas</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="instagram">Instagram Kelas</label>
                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram"  required value="{{ old('instagram') }}">
                        @error('instagram')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Jumlah Siswa</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah"  required value="{{ old('jumlah') }}">
                        @error('jumlah')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for='id_angkatan'>Pilih Angkatan</label>
                        <select class="form-control selectric" name='id_angkatan'>
                            @foreach ($angkatan as $list)
                            @if (old('id_angkatan')==$list->id)
                                <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                            @else
                                <option value="{{ $list->id }}">{{ $list->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="fotbar" class="form-label">Foto Kelas</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('fotbar') is-invalid @enderror" type="file" accept="image/*" id="fotbar" name="fotbar" onchange="previewImage()">
                        @error('fotbar')
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
    <script>
        function previewImage(){
        const image=document.querySelector('#fotbar');
        const imgPreview=document.querySelector('.img-preview');
        imgPreview.style.displat='block';
        const oFreader=new FileReader();
        oFreader.readAsDataURL(image.files[0]);
        oFreader.onload=function(oFREvent){
        imgPreview.src=oFREvent.target.result;
    }
  }
    </script>
@endsection
