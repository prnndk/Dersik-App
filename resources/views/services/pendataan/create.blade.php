@extends('dashboard.layouts.main')
@section('webtitle','Form Pendataan')
@section('container')
    <div class="card">
            <div class="card-header">
                <a href="{{ route('pendataan.index') }}" class="btn btn-icon-sm "><i class="fas fa-arrow-left"></i></a>
                <h4>Form Pendataan</h4>
            </div>
        <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <form action="{{ route('pendataan.store') }}" role="form" method="post" autocomplete="off">
                @csrf
            <div class="row">
                <div class="form-group col-md-6">
                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required autofocus value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
                </div>
                {{-- input email --}}
                <div class="form-group col-md-6">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
                </div>
                {{-- select kelas --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Kelas <span class="text-danger">*</span></label>
                <select class="form-control select2" name='kelas'>
                    <option value="" disabled selected>-Pilih Kelas-</option>
                    @foreach ($kelas as $list)
                        @if (old('kelas')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->kelas }}</option>
                        @else
                        <option value="{{ $list->id }}">{{ $list->kelas }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            {{-- select status --}}
            <div class="form-group col-md-6">
                <label for='status'>Status Sekarang <span class="text-danger">*</span></label>
                <select class="form-control select2" name='status' id="status">
                    <option value="" selected disabled>-Pilih Status-</option>
                    @foreach ($status as $s )
                    @if (old('status')==$s->id)
                    <option value="{{ $s->id }}" selected>{{ $s->nama }}</option>
                    @else
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endif
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- select detail_status --}}
            <div class="form-group col-md-6 detail">
                <div class="pilih" id="pilih">
                    <label for='instansi'>Detail Status <span class="text-danger">*</span></label>
                    <select class="form-control instansi" name='instansi' id="instansi">
                        <option value="" selected disabled>-Pilih Detail Status-</option>
                    </select>
                    @error('instansi')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- Cek kampus ada di list --}}
                <div class="form-check">
                    <input type="checkbox" class="form-check-input tidak-ada" name="tidak-ada" id="tidak-ada">
                    <label class="form-check-label" for="tidak-ada">Data yang anda inginkan tidak ada? </label>
                </div>
                {{-- Input manual --}}
                <div class="input-manual" id="input-manual">
                    <label for="manual">Nama Kampus</label>
                    <input type="text" name="instansi_manual" id="instansi_manual" class="form-control manual">
                </div>
                @error('instansi_manual')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- input tempat --}}
            <div class="form-group col-md-6 tempat">
                <label id="tempat" for="detail_status">Jurusan/Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" name="detail_status" id="detail_status" class="form-control @error('detail_status') is-invalid @enderror" value="{{ old('detail_status') }}" required>
                @error('detail_status')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>
            {{-- select domisili --}}
            <div class="form-group col-md-6">
                <label for='domisili'>Kota Domisili <span class="text-danger">*</span></label>
                <select class="form-control longselect" name='domisili'>
                    <option value="" selected disabled>-Pilih Kota-</option>
                        @foreach ($kab as $list)
                        @if (old('domisili')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->name }}</option>
                        @else
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @endif
                        @endforeach
                </select>
                @error('domisili')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- teman smasa --}}
            <div class="form-group col-md-6">
                <label for="teman_smasa" class="d-block">Teman Smasa satu domisili/kampus <span class="text-danger">*</span></label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('teman_smasa') is-invalid @enderror" type="radio" name="teman_smasa" value="Ada" id="teman_smasa" {{ old('teman_smasa')=='Ada' ? 'checked':''}}>
                  <label class="form-check-label" for="Ada">
                    Iya, Ada teman
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('teman_smasa') is-invalid @enderror" type="radio" name="teman_smasa" value="Tidak Ada" id="teman_smasa" {{ old('teman_smasa')=="Tidak Ada" ? 'checked':'' }}>
                  <label class="form-check-label" for="Tidak Ada">
                   Tidak ada
                  </label>
                </div>
                @error('teman_smasa')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- angkatan --}}
            <div class="form-group col-md-6">
                <label for='angkatan_id'>Pilih Angkatan Anda <span class="text-danger">*</span></label>
                <select class="form-control select2" name='angkatan_id'>
                    <option value="" selected disabled>-Pilih Angkatan-</option>
                        @foreach ($angkatan as $angkat)
                        @if (old('angkatan_id')==$angkat->id)
                        <option value="{{ $angkat->id }}" selected>{{ $angkat->nama }}</option>
                        @else
                        <option value="{{ $angkat->id }}">{{ $angkat->nama }}</option>
                        @endif
                        @endforeach
                </select>
                @error('angkatan_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- No-hp --}}
            <div class="form-group col-md-6">
                <label for="nomor">Nomor Hp Aktif <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" required value="{{old('nomor') }}">
                @error('nomor')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- end row --}}
            <i class="mb-2">Untuk tanda <span class="text-danger">*</span> adalah isian yang wajib</i>
        </div>
        <button class="btn btn-primary" type="submit">Submit data</button>
        </form>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $(document).ready(function () {
            $('#input-manual').hide()
            if($("#tidak-ada").change(function () { 
                if ($(this).prop('checked')) {
                    $('.input-manual').show()
                    $('.manual').attr('required',true)
                    $('.pilih').hide()
                }else{
                    $('.pilih').show()
                    $('.input-manual').hide()
                }
            }));
            $('#instansi').select2();
            $('#status').change(function (e) { 
                e.preventDefault();
                let statusId=$(this).val();
                if(statusId==3||statusId==5){
                    $('.detail').hide()
                    $('#tempat').text("Kegiatan Sekarang")
                }
                else if(statusId==1||statusId==2||statusId==4){
                    $('.detail').show()
                    $('#tempat').text("Jurusan/Tempat Kerja")
                    $.ajax({
                        type: "post",
                        url: "{{ route('cekDetail') }}",
                        data: {id_status:statusId,_token:"{{ csrf_token() }}"},
                        success: function (response) {
                            $('.instansi').append('<option value="" disabled selected>-Pilih Universitas/Nama Pekerjaan-</option>');
                            $.each(response, function (key, value) {
                                $('.instansi').append('<option value="'+value.id+'">'+value.nama+'</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
