@extends('dashboard.layouts.main')
@section('container')
<div class="section-header"><h3>Edit Kelas</h3></div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kelas.update',$kelas->id) }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas"  required value="{{ old('kelas',$kelas->kelas) }}">
                        @error('kelas')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Nama Kelas</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama',$kelas->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="instagram">Instagram Kelas</label>
                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram"  required value="{{ old('instagram',$kelas->instagram) }}">
                        @error('instagram')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah">Jumlah Siswa</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah"  required value="{{ old('jumlah',$kelas->jumlah) }}">
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
                            @if (old('id_angkatan',$kelas->id_angkatan)==$list->id)
                                <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                            @else
                                <option value="{{ $list->id }}">{{ $list->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="fotbar" class="form-label">Foto Kelas</label>
                        <input type="hidden" name="oldFotbar" value="{{ $kelas->fotbar }}">
                        @if ($kelas->fotbar)
                        <img src="{{ asset('storage/'.$kelas->fotbar) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input class="form-control @error('fotbar') is-invalid @enderror" type="file" accept="image/*" id="fotbar" name="fotbar" onchange="previewImage()">
                        @error('fotbar')
                        <div class="invalid-feedback">
                        {{ $message }}
                         </div>
                         @enderror
                    </div>
                </div>
                <a href="{{ route('kelas.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Back to index</a>
                <button type="submit" class="btn btn-primary">Edit {{ $kelas->kelas }} data</button>
            </form>
        </div>
    </div>
    <script>
        function previewImage(){
        const image=document.querySelector('#fotbar');
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