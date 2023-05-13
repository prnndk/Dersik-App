@extends('dashboard.layouts.main')
@section('webtitle','Buat Informasi')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>Create New Pengumuman</h4>
            <div class="card-header-action">
                <a href="{{route('informasi.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Pengumuman</a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('informasi.store')}}" role="form" enctype="multipart/form-data">
            @csrf
                <div class="form-group col-md-8">
                    <label for="judul">Judul Informasi</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"  required value="{{ old('judul') }}">
                    @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for='kategori_informasi'>Pilih Kategori Informasi</label>
                    <select class="form-control select2" name='kategori_informasi' id="kategori_informasi">
                        <option value="" disabled selected>-Pilih Kategori Informasi-</option>
                        @foreach ($kategori as $k)
                            @if (old('kategori_informasi')==$k->id)
                                <option value="{{ $k->id }}" selected>{{ $k->name }}</option>
                            @endif
                            <option value="{{ $k->id }}">{{ $k->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for='angkatan'>Pilih Angkatan Anda</label>
                    <select class="form-control select2" name='angkatan' id="angkatan">
                        <option value="" disabled selected>-Pilih Angkatan-</option>
                        @foreach ($angkatan as $a)
                            @if (old('angkatan')==$a->id)
                                <option value="{{ $a->id }}" selected>{{ $a->nama }}</option>
                            @endif
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="informasi_type">Pilih Tipe Tayangan Informasi</label>
                    <select class="form-control select2" name="informasi_type" id="informasi_type">
                        <option value="" disabled selected>-Pilih Tipe Tayangan Informasi-</option>
                        <option value="1">Modal</option>
                        <option value="2">Feed</option>
                        <option value="3">Email Blasting</option>
                        <option value="4">Marquee</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="shortlink">Ingin buat shortlink?</label>
                    <select class="form-control select2" name="shortlink" id="shortlink">
                        <option value="" disabled selected>-Pilih-</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="shortened">Shortened Link</label>
                    <input type="text" class="form-control @error('shortened') is-invalid @enderror" id="shortened" name="shortened" value="{{ old('shortened') }}">
                </div>
                <div class="form-group col-md-8">
                    <label for="img" class="form-label">Foto</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5 rounded-lg">
                    <input class="form-control @error('img') is-invalid @enderror" type="file" accept="image/*" id="img" name="img" onchange="previewImage()">
                    @error('img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-8 mb-3">
                    <label for="body" class="form-label">Isi Informasi</label>
                    @error('body')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                    <trix-editor input="body"></trix-editor>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
    <script>
        function previewImage(){
            const image=document.querySelector('#img');
            const imgPreview=document.querySelector('.img-preview');
            imgPreview.style.display='block';
            const oFreader=new FileReader();
            oFreader.readAsDataURL(image.files[0]);
            oFreader.onload=function(oFREvent){
                imgPreview.src=oFREvent.target.result;
            }
        }
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
@endsection
