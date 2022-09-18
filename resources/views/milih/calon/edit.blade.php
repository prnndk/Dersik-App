@extends('dashboard.layouts.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>Edit data ketua {{ $ketua->nama }}</h4>
            <div class="card-header-action">

            </div>
        </div>
        <div class="card-body">
            <form method="POST" autocomplete="off" action="{{ route('ketua.update',$ketua->id) }}" class="form1" role="form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                <div class="form-group col-md-6">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama',$ketua->nama) }}">
                @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="form-group col-md-6">
                <label for="panggilan">Panggilan</label>
                <input type="text" class="form-control @error('panggilan') is-invalid @enderror" id="panggilan" name="panggilan"  required value="{{ old('panggilan',$ketua->panggilan) }}">
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
                                @if (old('pemilihan_id',$ketua->pemilihan_id)==$list->id)
                                    <option value="{{ $list->id }}" selected>{{ $list->nama }}</option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                <div class="form-group col-md-6">
                <label for="img" class="form-label">Foto</label>
                <input type="hidden" name="oldImg" value="{{ $ketua->img }}">
                @if ($ketua->img)
                <img class="img-preview img-fluid mb-3 col-sm-5 d-block" src="{{ asset('storage/'.$ketua->img) }}">
                @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('img') is-invalid @enderror" type="file" accept="image/*" id="img" name="img" onchange="previewImage()">
                @error('img')
                <div class="invalid-feedback">
                {{ $message }}
                 </div>
                 @enderror
                </div>
                {{-- end form --}}
                </div>
            <div class="row">
                {{-- select ketua --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Pilih Ketua</label>
                <select class="form-control selectric" required name='ketua_id'>
                    <option value="{{ $ketua->id }}" selected disabled>{{$ketua->nama}}</option>
                </select>
            </div>
                {{-- select kelas --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Kelas</label>
                <select class="form-control selectric" required name='kelas'>
                        <option value="" selected disabled>-Pilih Kelas-</option>
                        @foreach ($kelas as $list)
                        @if (old('kelas',$detail->kelas)==$list->id)
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
                        @if (old('tempatlahir',$detail->tempatlahir)==$list->id)
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
                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dob"value="{{ old('dob',$detail->dob) }}">
                @error('dob')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
            </div>
            {{-- instagram --}}
            <div class="form-group col-md-6">
                <label for="ig">Instagram Account</label>
                <input type="text" class="form-control @error('ig') is-invalid @enderror" id="ig" name="ig"  required value="{{ old('ig',$detail->ig) }}">
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
                <input id="pengalaman" type="hidden" name="pengalaman" value="{{ old('pengalaman',$detail->pengalaman) }}">
                <trix-editor input="pengalaman"></trix-editor>
            </div>
        </div>
            {{-- end form --}}
            <a href="{{ route('ketua.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back to index</a>
            <button type="submit" class="btn btn-primary timbus">Submit Form</button>
        </form>
        </div>
    </div>
@endsection
@section('customjs')
<script>
// $(".timbus").click(function (e) { 
//         e.preventDefault();
//         const form1=$('.form1');
//         const form2=$('.form2');
//     Swal.fire({
//     title: 'Apakah Anda Yakin?',
//     text: 'Anda akan mengupload 2 form sekaligus',
//     icon: 'info',
//     showCloseButton:true,
//     showCancelButton:true,
//     confirmButtonText: 'Ya, Kirim form',
//     }).then(result=> {
//     if (result.isConfirmed) {
//         form1.submit();
//         form2.submit();
//         }
//     });
// });
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