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
            <div class="card-header"><h4>Table List of User</h4>
                <div class="card-header-action">
                </div>
            </div>
            <table class="table" id="table">
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
                   <td>{{ $list->Kelas->kelas }}</td>
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
