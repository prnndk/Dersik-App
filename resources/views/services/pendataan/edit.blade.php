@extends('dashboard.layouts.main')
@section('webtitle','Edit Pendataan '.$data->nama)
@section('container')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pendataan.index') }}" class="btn"><i class="fas fa-arrow-left"></i></a>
                <h4>Edit this data</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pendataan.update',$data->id) }}" role="form" method="post" autocomplete="off">
                @method('put')
                @csrf
            <div class="row">
                <div class="form-group col-md-6">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama',$data->nama) }}">
                @error('nama')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
                </div>
                {{-- input email --}}
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email',$data->email) }}">
                @error('email')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
                </div>
                {{-- select kelas --}}
            <div class="form-group col-md-6">
                <label for='kelas'>Kelas</label>
                <select class="form-control select2" name='kelas'>
                    <option value="" disabled selected>-Pilih Kelas-</option>
                    @foreach ($kelas as $list)
                        @if (old('kelas',$data->kelas)==$list->id)
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
                    @if (old('status',$data->status)==$s->id)
                    <option value="{{ $s->id }}" selected>{{ $s->nama }}</option>
                    @else
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            {{-- Input manual --}}
            <div class="form-group col-md-6">
                <div class="input-manual" id="input-manual">
                    <label for="instansi">Nama Tempat status</label>
                    <input type="text" name="instansi" id="instansi" class="form-control manual" value="{{ old('instansi',$data->instansi) }}">
                </div>
            </div>
            {{-- input tempat --}}
            <div class="form-group col-md-6 tempat">
                <label id="tempat" for="detail_status">Jurusan/Pekerjaan</label>
                <input type="text" name="detail_status" id="detail_status" class="form-control @error('detail_status') is-invalid @enderror" value="{{ old('detail_status',$data->detail_status) }}" required>
                @error('detail_status')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>
            {{-- select domisili --}}
            <div class="form-group col-md-6">
                <label for='domisili'>Kota Domisili</label>
                <select class="form-control longselect" name='domisili'>
                    <option value="" selected disabled>-Pilih Kota-</option>
                        @foreach ($kab as $list)
                        @if (old('domisili',$data->domisili)==$list->id)
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
                  <input class="form-check-input @error('teman_smasa') is-invalid @enderror" type="radio" name="teman_smasa" value="Ada" id="teman_smasa" {{ old('teman_smasa',$data->teman_smasa)=='Ada' ? 'checked':''}}>
                  <label class="form-check-label" for="Ada">
                    Iya, Ada teman
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error('teman_smasa') is-invalid @enderror" type="radio" name="teman_smasa" value="Tidak Ada" id="teman_smasa" {{ old('teman_smasa',$data->teman_smasa)=="Tidak Ada" ? 'checked':'' }}>
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
                        @if (old('angkatan_id',$data->angkatan_id)==$angkat->id)
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
                <input type="number" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" required value="{{old('nomor',$data->nomor) }}">
                @error('nomor')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- end row --}}
            <i class="mb-2">Untuk tanda <span class="text-danger">*</span> adalah isian yang wajib</i>
        </div>
    </div>
</div>
</div>
<div class="col-md-4">
    @if(auth()->user()->role=='admin')
    <div class="card">
        <div class="card-header"><h4>Admin Menu</h4><div class="card-header-action">
            <button class="btn btn-danger" id="delete" data-form-id="{{ $data->id }}" type="button"><i class="fas fa-trash"></i> Delete</button>
        </div></div>
        <div class="card-body">
            <div class="form-group">
                <label for="review">Status Pendataan</label>
                <select class="form-control select2" name="review" id="review">
                    <option value="0" {{ old('review',$data->review)=='0' ? 'selected':'' }}>Dalam Peninjauan</option>
                    <option value="1" {{ old('review',$data->review)=='1' ? 'selected':'' }}>Diterima</option>
                    <option value="2" {{ old('review',$data->review)=='2' ? 'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div class="form-group" id="messagebox">
                <label for="message">Review Penolakan</label>
                <input type="text" class="form-control @error('message') is-invalid @enderror" id="message" name="message" value="{{ old('message',$data->message) }}">
                @error('message')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    @endif
</div>
</div>
<button class="btn btn-primary" type="submit">Submit data</button>
</form>
@endsection
@section('customjs')
    <script>
        $(document).ready(function(){
            $('#messagebox').hide();
            $('.select2').select2();
            $('#review').on('change',function(){
                if($(this).val()=='2'){
                    $('#messagebox').show()
                    $('#message').attr('required',true);
                }else{
                    $('#messagebox').hide();
                    $('#message').attr('required',false);
                    $('#message').val('no message');
                }
            });
            if($('#review').val()=='2'){
                $('#messagebox').show()}
            $('#delete').on('click',function(){
            var id = $(this).data('form-id');
            Swal.fire({
            title: "Apakah anda yakin?",
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus data!",
            cancelButtonText: "Tidak, batalkan!",
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: "{{ url('/pendataan') }}/"+id,
                type: "POST",
                data: {
                '_method': 'DELETE',
                '_token': "{{ csrf_token() }}"
                },
                success: function(response){
                    Swal.fire({
                    title: "Berhasil!",
                    text:''+response.message+'',
                    icon: "success",
                    });
                window.location.href = "{{ url('/pendataan') }}";
                },
                error: function(data){
                    Swal.fire("Data gagal dihapus", {
                    icon: "error",
                    });
                }
                });
            } else {
                Swal.fire({
                icon:'info',
                title:'Data tidak jadi dihapus',
                text:'Data anda aman',
                showCloseButton: true,
                });
            }
            });
        });
        });
    </script>
@endsection
