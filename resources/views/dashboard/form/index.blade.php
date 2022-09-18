@extends('dashboard.layouts.main')
@section('container')
{{-- put your content here --}}
<div class="card">
      <div class="card-header">
        <h3>Form Registrasi Promnight dersik 22</h3>
      </div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        {{ session('success')}}
      </div>
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-error alert-dismissable show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>$times;</span>
        </button>
        {{ session('error') }}
      </div>
    </div>
    @endif
    @if (auth()->user()->role =='admin')
    <div class="card-body">
      <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Partisipasi</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($index as $list )
            
          <tr>
           <td>{{ $loop->iteration }}</td>
           <td>{{ $list->nama }}</td>
           <td>{{ $list->kesediaan }}</td>
           <td>
            <a href="/dashboard/formprom/{{ $list->id }}" class="table-badge badge text-light p-2 mt-1 bg-info"><i class="far fa-eye"></i></a>
            <a href="/dashboard/formprom/{{ $list->id }}/edit" class="table-badge badge text-light p-2 mt-1 bg-warning"><i class="far fa-edit"></i></a>
            <form action="/dashboard/formprom/{{ $list->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="table-badge badge text-light p-2 mt-1 bg-danger border-0" onclick="return confirm('Delete data?')"><i class="far fa-trash-alt"></i></button>
            </form>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @elseif (auth()->user()->role=='User')
    @foreach ($index as $user )
    @if ($user->user_id ==auth()->user()->id)
    <div class="card">
      <div class="card-body">
        <h5>Terimakasih anda telah mengisi registrasi Promnight 2022!</h5>
        <div class="card">
          <div class="card-body">
            <p>Berikut adalah data yang anda isikan:</p>
            @foreach ($datauser as $data )
              <p>Nama: {{ $data->nama }}</p>
              <p>Email: {{ $data->email }}</p>
              <p>Kelas: {{ $data->kelas->kelas }}</p>
              <p>Keikutsertaan: {{ $data->kesediaan }}</p>
              <p>Kedinasan: {{ $data->kedinasan }}</p>
            @endforeach
          </div>
        </div>
        <a href="/dashboard" class="btn btn-primary">Back To Dashboard</a>
      </div>
    </div>
    @else
    @endif
    @endforeach
    <div class="card">
      <div class="card-body">
        <a href="/dashboard/formprom/create" class="btn btn-primary">Registrasi</a>
      </div>
    </div>
    @endif
  </div>
  @endsection