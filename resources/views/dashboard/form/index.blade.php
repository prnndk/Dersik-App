@extends('dashboard.layouts.main')
@section('container')
<div class="section-header">
  <h2>Promnight Menu</h2>
</div>

@if (auth()->user()->role=='admin')
<div class="card">
  <div class="card-header">
    <h4>List Form Prom</h4>
    <div class="card-header-action">
      <a href="create" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Form</a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-responsive-sm" id="table">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Ikut/Tidak</th>
        <th scope="col">Kelas</th>
        <th scope="col">Kedinasan</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($index as $list )
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $list->nama }}</td>
          <td>{{ $list->email }}</td>
          <td>
          @if ($list->kesediaan=='Ikut')
          <span class="badge badge-success">{{ $list->kesediaan }}</span>
          @else
          <span class="badge badge-danger">{{ $list->kesediaan }}</span>
          @endif
          </td>
          @if ($list->Kelas)
          <td>{{ $list->Kelas->kelas }}</td>
          @else
          <td>No Data</td>
          @endif
          <td>{{ $list->kedinasan }}</td>
          <td>
          <a href="{{$list->id}}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
          <a href="{{ $list->id }}/edit" class="badge badge-warning mt-1"><i class="far fa-edit"></i></a>
          <form action="{{ $list->id }}" method="post" class="d-inline">
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
@else
<div class="card">
  @if ($datauser)
  <div class="card-header">
    <h4>Cek pendaftaran anda</h4>
  </div>
  <div class="card-body">
    <p>Anda telah melakukan pendaftaran dengan data berikut ini.</p>
    
  </div>
  @else
  <div class="card-header">
    <h4>Registrasi Prom</h4>
  </div>
  <div class="card-body">
    <p>Lakukan registrasi prom dengan mengisi form dibawah ini</p>
    <a href="create" class="btn btn-primary">Registrasi</a>
  </div>
  @endif
  {{-- Cek Sudah regis --}}
</div>
@endif
{{-- Cek Role User --}}
@endsection