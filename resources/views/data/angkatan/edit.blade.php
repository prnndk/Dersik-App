@extends('dashboard.layouts.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>Edit Data Angkatan {{ $angkatan->nama }}</h4>
            <div class="card-header-action">
                <a href="{{ route('angkatan.index') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('angkatan.update',$angkatan->id) }}" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                @method('put')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nama">Nama Angkatan</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama',$angkatan->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tahun">Tahun Angkatan</label>
                        <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun"  required value="{{ old('tahun',$angkatan->tahun) }}">
                        @error('tahun')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email Angkatan</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email',$angkatan->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ig">Alamat Instagram Angkatan</label>
                        <input type="text" class="form-control @error('ig') is-invalid @enderror" id="ig" name="ig"  required value="{{ old('ig',$angkatan->ig) }}">
                        @error('ig')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ketua">Ketua Angkatan</label>
                        <input type="text" class="form-control @error('ketua') is-invalid @enderror" id="ketua" name="ketua" value="{{ old('ketua',$angkatan->ketua) }}">
                        @error('ketua')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="logo" class="form-label">Logo Angkatan</label>
                        <input type="hidden" name="oldLogo" value="{{ $angkatan->logo }}">
                        @if($angkatan->logo)
                        <img src="{{ asset('storage/'.$angkatan->logo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input class="form-control @error('logo') is-invalid @enderror" type="file" accept="image/*" id="logo" name="logo" onchange="previewImage()">
                        @error('logo')
                        <div class="invalid-feedback">
                        {{ $message }}
                         </div>
                         @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="filosofi" class="form-label">Filosofi Angkatan</label>
                        @error('filosofi')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <input id="filosofi" type="hidden" name="filosofi" value="{{ old('filosofi',$angkatan->filosofi) }}">
                        <trix-editor input="filosofi"></trix-editor>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="far fa-pen-to-square"></i> Edit {{ $angkatan->nama }}</button>
            </form>
        </div>
    </div>
    <script>   
    function previewImage(){
    const image=document.querySelector('#logo');
    const imgPreview=document.querySelector('.img-preview');
    imgPreview.style.display='block';
    const oFreader=new FileReader();
    oFreader.readAsDataURL(image.files[0]);
    oFreader.onload=function(oFREvent){
      imgPreview.src=oFREvent.target.result;
    }
    }
    </script>
@endsection