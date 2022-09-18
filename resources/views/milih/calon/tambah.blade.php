@extends('dashboard.layouts.main')
@section('webtitle','Tambah Calon')
@section('container')
    @if(auth()->user()->role=="User")
        <div class="section-header"><h4 class="text-danger">Role anda tidak bisa menambahkan ketua</h4></div>
    @else
<div class="section-header"><h3>Pemilihan ketua angkatan DERSIK 22</h3></div>
    <div class="card">
        <div class="card-header"><h4>Tambah Calon Ketua</h4></div>
        <div class="card-body">
            <form method="POST" action="/dashboard/ketua" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
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
                <label for="panggilan">Panggilan</label>
                <input type="text" class="form-control @error('panggilan') is-invalid @enderror" id="panggilan" name="panggilan"  required value="{{ old('panggilan') }}">
                @error('panggilan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
                </div>
                    <div class="form-group col-md-6">
                        <label for='pemilihan_id'>Pilih Kategori Voting</label>
                        <select class="form-control selectric" required name='pemilihan_id'>
                            <option value="" selected disabled>-Pilih Voting-</option>
                            @foreach ($voting as $list)
                                @if (old('pemilihan_id')==$list->id)
                                    <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                <div class="form-group col-md-6">
                <label for="img" class="form-label">Foto</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('img') is-invalid @enderror" accept="image/*" type="file" id="img" name="img" onchange="previewImage()">
                @error('img')
                <div class="invalid-feedback">
                {{ $message }}
                 </div>
                 @enderror
                </div>
                {{-- end form --}}
                </div>
            <button type="submit" class="btn btn-primary">Submit Form</button>
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
</script>
    @endif
@endsection
