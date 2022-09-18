@extends('dashboard.layouts.main')
@section('webtitle','Form Pendataan')
@section('container')
    @if(auth()->user()->role=='admin')
    <div class="card">
            <div class="card-header">
                <h4>Form Pendataan</h4>
                <div class="card-header-action">
                    <a href="{{ route('pendataan.index') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-arrow-left"></i> Back To Index</a>
                </div>
            </div>
        <div class="card-body">
            <form action="{{ route('pendataan.store') }}" role="form" method="post" autocomplete="off">
                @csrf
            <div class="row">
                <div class="form-group col-md-6">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required autofocus value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
                </div>
                {{-- select kelas --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Kelas</label>
                <select class="form-control select2" name='kelas'>
                    <option value="" disabled selected>-PILIH KELAS-</option>
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
                <label for='status'>Status Sekarang</label>
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
            </div>
            {{-- select detail_status --}}
            <div class="form-group col-md-6">
                <label for='instansi'>Detail Status</label>
                <select class="form-control instansi" name='instansi' id="instansi">
                    <option value="" selected disabled>-Pilih Detail Status-</option>
                </select>
            </div>
            {{-- select tempat --}}
            <div class="form-group col-md-6">
                <label for='detail_status'>Jurusan/ Pekerjaan</label>
                <select class="form-control select2" name='detail_status'>
                    <option value="" selected disabled>-Pilih Jurusan/ Pekerjaan-</option>
                        @foreach ($detail_status as $detail)
                        @if (old('detail_status')==$detail->id)
                        <option value="{{ $detail->id }}" selected>{{ $detail->nama }}</option>
                        @else
                        <option value="{{ $detail->id }}">{{ $detail->nama }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
            {{-- select domisili --}}
            <div class="form-group col-md-6">
                <label for='domisili'>Kota Domisili</label>
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
            </div>
            {{-- teman smasa --}}
            <div class="form-group">
                <label for="teman_smasa" class="d-block">Teman Smasa satu domisili/kampus</label>
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
                <label for='angkatan_id'>Pilih Angkatan Anda</label>
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
            </div>
            {{-- No-hp --}}
            <div class="form-group col-md-6">
                <label for="nomor">Nomor Hp Aktif</label>
                <input type="number" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" required value="{{old('nomor') }}">
                @error('nomor')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- end row --}}
            </div>
            </form>
        </div>
    </div>
    @elseif(auth()->user()->role!='admin')
        <div class="card">
            <div class="card-header"><h4 class="text-danger">Mohon maaf halaman ini sedang dalam pengembangan</h4></div>
        </div>
    @endif
@endsection
@section('customjs')
    <script>
        $(document).ready(function () {
            $('#instansi').select2({
                minimumInputLength:3
            })
            $('#status').change(function (e) { 
                e.preventDefault();
                let statusId=$(this).val();
                $.ajax({
                    type: "post",
                    url: "{{ route('cekDetail') }}",
                    data: {id_status:statusId,_token:"{{ csrf_token() }}"},
                    success: function (response) {
                        $('.instansi').html("<option value=''>-Pilih Detail-</option>");
                        $.each(response.detail, function (key, value) { 
                             $('.instansi').append("<option value="+value.id+">"+value.nama+"</option>")
                        });
                    }
                });
            });
        });
    </script>
@endsection
