@extends('layouts.auth')
@section('head',"Registrasi Akun")
@section('content')
   <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <h5><strong>SMASA ALUMNI</strong> Site</h5>
            </div>
            <div class="card card-primary">
              <div class="card-header"><h4>Buat Akun</h4></div>
              {{-- show all error --}}
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error )
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              {{-- end show all error --}}
              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Nama Lengkap</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus required value="{{ old('name') }}" placeholder="Your Full name here">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="username">Enter your username</label>
                      <input id="username" type="text" class="form-control @error('username') is_invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation" class="d-block">Password Confirmation</label>
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                  </div>

                  <div class="form-divider">
                    Detail Informasi
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Tempat Lahir</label>
                      <select class="form-control select2" name="tempatlahir" id="tempatlahir">
                          <option value="" disabled selected>-Pilih Kota-</option>
                        @foreach ($cities as $city )
                          @if(old('tempatlahir')==$city->id)
                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                            @else
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endif
                        @endforeach
                      </select>
                      @error('tempatlahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    </div>
                   <div class="form-group col-6">
                      <label for="dob">Tanggal Lahir</label>
                      <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" required>
                        @error('dob')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-6">
                      <label for="angkatan_id">Angkatan</label>
                      <select class="form-control select2" name="angkatan_id" id="angkatan_id">
                            <option value="" disabled selected>-Pilih Angkatan-</option>
                            @foreach ($angkatans as $angkatan )
                            @if(old('angkatan_id')==$angkatan->id)
                                <option value="{{ $angkatan->id }}" selected>{{ $angkatan->nama .'/'. $angkatan->tahun }}</option>
                                @else
                                <option value="{{ $angkatan->id }}">{{ $angkatan->nama .'/'. $angkatan->tahun }}</option>
                                @endif
                            @endforeach
                      </select>
                        @error('angkatan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                     <div class="form-group col-6">
                      <label for="kelas_id">Kelas</label>
                      <select class="form-control select2" name="kelas_id" id="kelas_id">
                      </select>
                        @error('kelas_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>
                <div class="form-group d-grid">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
                <div class="mt-5 text-muted text-center">
                  Already have an account? <a href="{{ route('login') }}">Login</a>
                </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; SMASA DERSIK {{ date('Y') }}
            </div>
          </div>
        </div>
@endsection

@push('scripts')
        <script>
            $(document).ready(function(){
                $('#tempatlahir').select2({
                    placeholder: "Pilih Kota",
                });
                $('#angkatan_id').select2({
                    placeholder: "Pilih Angkatan",
                });
                $('#angkatan_id').change(function (e) { 
                    e.preventDefault();
                    let id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "/api/kelasByAngkatan",
                        data: {id:id},
                        dataType: "JSON",
                        success: function (response) {
                            $('#kelas_id').empty();
                            $('#kelas_id').select2({
                                placeholder: "Pilih Kelas",
                            });
                            $('#kelas_id').append('<option value="" disabled selected>-Pilih Kelas-</option>');
                            $.each(response.kelas, function (i, val) { 
                                $('#kelas_id').append('<option value="'+val.id+'">'+val.kelas+ '/' +val.nama+'</option>');
                            });
                        }
                    });
                });
            });
        </script>
@endpush