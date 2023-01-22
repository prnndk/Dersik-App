@extends('dashboard.layouts.main')
@section('webtitle','Data User App')
@section('container')
    <div class="section-header"><h3>Registered User</h3>
    <div class="section-header-breadcrumb">
        <a href="{{ route('userlist.create') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Create New User</a>
    </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if (session()->has('error'))
                
            @endif
            <div class="card-header"><h4>Table List of User</h4>
                <div class="card-header-action">
                    <a href="{{ route('exportuser') }}" class="btn btn-success">Export Data</a>
                    <button class="btn btn-info" id="import">Import Data</button>
                </div>
            </div>
            <table class="table table-responsive-sm" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($user as $list )
                  <tr>
                   <td>{{ $loop->iteration }}</td>
                   <td>{{ $list->name }}</td>
                   <td>{{ $list->username }}</td>
                   <td>{{ $list->email }}</td>
                   @if ($list->Kelas)
                   <td>{{ $list->Kelas->kelas }}</td>
                   @else
                    <td>No Data</td>
                   @endif
                   <td>
                    <a href="/userlist/{{$list->id}}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
                    <a href="/userlist/{{ $list->id }}/edit" class="badge badge-warning mt-1"><i class="far fa-edit"></i></a>
                    <form action="/userlist/{{ $list->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge badge-danger mt-1 border-0" onclick="return confirm('Delete data?')"><i class="far fa-trash-alt"></i></button>
                    </form>
                  </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('bawahsection')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import user from Excel</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('import.user') }}" id="formSubmit" role="form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="custom-file">
                <input type="file" name="file" id="file" class="custom-file-input @error('teman_smasa') is-invalid @enderror" accept=".xlsx, .xls, .csv">
                <label for="file" class="custom-file-label">Choose File</label>
                <small class="form-text text-muted">Hanya menerima extensi .xlsx .xls .csv</small>
                @error('teman_smasa')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" id="modalSubmit" class="btn btn-primary">Tambahkan Data</button>
        </div>
            </form>
        </div>
        </div>
    </div>
@endsection
@section('customjs')
<script>
    @if (session()->has('error'))
    $('#modal').modal('show');                   
    @endif
    $('#import').click(function (e) { 
        e.preventDefault();
        $('#modal').modal('show')
    });
    $('#modalSubmit').attr('disabled',true);
    $('#file').change(function (e) { 
        e.preventDefault();
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
        $('#modalSubmit').attr('disabled',false);
    });
    $('#modalSubmit').click(function (e) { 
        e.preventDefault();
        $('#modalSubmit').addClass('btn-progress');
        $('#modalSubmit').attr('disabled',true);
        $('#formSubmit').submit()
    });
</script>
@endsection
