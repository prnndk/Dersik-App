@extends('dashboard.layouts.main')
@section('webtitle','Tambah User')
@section('container')
    <div class="card">
        <div class="card-body">
        <div class="card-header"><h4>Make New User</h4></div>
        <form action="{{ route('userlist.store') }}" role="form"  method="post">
            @csrf
            <div class="row">
            {{-- name --}}
            <div class="form-group col-md-5">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            {{-- email --}}
            <div class="form-group col-md-4">
                <label for="email">Active Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            {{-- username --}}
            <div class="form-group col-md-3">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  required value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            {{-- kelas --}}
            <div class="form-group col-md-4">
                <label for='angkatan_id'>Pilih Angkatan</label>
                <select class="form-control select2" name='angkatan_id' id="angkatan_id">
                    <option value="" disabled selected>-Pilih Angkatan-</option>
                    @foreach ($angkatans as $angkatan)
                        @if (old('angkatan_id')==$angkatan->id)
                            <option value="{{ $angkatan->id }}" selected>{{ $angkatan->nama .'/'. $angkatan->tahun}}</option>
                        @else
                            <option value="{{ $angkatan->id }}">{{ $angkatan->nama .'/'. $angkatan->tahun}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for='kelas_id'>Pilih Kelas</label>
                <select class="form-control select2" name='kelas_id' id="kelas_id">
                    
                </select>
            </div>
            {{-- tempatlahir --}}
            <div class="form-group col-md-4">
                <label for='tempatlahir'>Kabupaten/Kota Tempat Lahir</label>
                <select class="form-control select2" name='tempatlahir' id="tempatlahir" required>
                    <option value="" disabled selected>-Pilih Tempat Lahir-</option>
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
            <div class="form-group col-md-4">
                <label for="dob">Tanggal Lahir</label>
                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dob"value="{{ old('dob') }}">
                @error('dob')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
            </div>
            {{-- role --}}
            <div class="form-group col-md-4">
                <label for="role">Role User</label>
                <select name="role" class="form-control selectric">
                    <option value="User">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            {{-- password --}}
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  required value="{{ old('password') }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            {{-- end row --}}
            </div>
            <button type="submit" class="btn btn-primary">Submit new user</button>
            <a href="{{ route('userlist.index') }}" class="btn btn-info">Back To List</a>
        </form>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $("#angkatan_id").change(function(e){
            e.preventDefault();
            var angkatan_id = $(this).val();
            $.ajax({
                url: "/api/kelasByAngkatan",
                type: "GET",
                data: {
                    id: angkatan_id
                },
                success: function(data){
                    $('#kelas_id').empty();
                    $('#kelas_id').append('<option value="" disabled selected>-Pilih Kelas-</option>');
                    $.each(data.kelas, function(index, value){
                        $('#kelas_id').append('<option value="'+value.id+'">'+value.nama+' / '+value.kelas+'</option>');
                    });
                }
            });
        })
    </script>
@endsection
