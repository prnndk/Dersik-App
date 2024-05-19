@extends('dashboard.layouts.main')
@section('webtitle','Edit data '.$user->username)
@section('container')
    <div class="section-header">
        <h2>Edit Data User {{ $user->name }}</h2>
        <div class="section-header-breadcrumb">
            <a href="{{ route('userlist.index') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-arrow-left"></i> Back To Index</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('userlist.update',$user->uuid) }}" role="form"  method="post">
                @csrf
                @method('PUT')
                <div class="row">
                {{-- name --}}
                <div class="form-group col-md-5">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required value="{{ old('name',$user->name) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- email --}}
                <div class="form-group col-md-4">
                    <label for="email">Active Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  required value="{{ old('email',$user->email) }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- username --}}
                <div class="form-group col-md-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  required value="{{ old('username',$user->username) }}">
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- kelas --}}
                <div class="form-group col-md-4">
                    <label for='kelas_id'>Pilih Kelas</label>
                    <select class="form-control selectric" name='kelas_id' required>
                            @foreach ($kelas as $list)
                            @if (old('kelas_id',$user->kelas_id)==$list->id)
                            <option value="{{ $list->id }}" selected>{{ $list->kelas }}</option>
                            @else
                            <option value="{{ $list->id }}">{{ $list->kelas }}</option>
                            @endif
                            @endforeach
                    </select>
                </div>
                {{-- tempatlahir --}}
                <div class="form-group col-md-4">
                    <label for='tempatlahir'>Kabupaten/Kota Tempat Lahir</label>
                    <select class="form-control selectric" name='tempatlahir' required>
                            @foreach ($kab as $list)
                            @if (old('tempatlahir',$user->tempatlahir)==$list->id)
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
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dob"value="{{ old('dob',$user->dob) }}">
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
                        @if ($user->role=='User')
                        <option value="User" selected>User</option>
                        <option value="admin" >Admin</option>
                        @elseif ($user->role=='admin')
                        <option value="admin" selected>Admin</option>
                        <option value="User" >User</option>
                        @endif
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
                <button type="submit" class="btn btn-primary">Edit this user</button>
                <a href="{{ route('userlist.index') }}" class="btn btn-info">Back To List</a>
            </form>
        </div>
    </div>
@endsection
