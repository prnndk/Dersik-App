@extends('dashboard.layouts.main')
@section('webtitle','Data Calon')
@section('container')
<div class="section-header"><h3>Data lengkap ketua</h3>
<div class="section-header-breadcrumb">
  <a href="/dashboard/dataketua/create" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Tambah Data</a>
</div>
</div>
<div class="card">
  <div class="card-body">
{{-- content start --}}
<table class="table table-responsive-md">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">TTL</th>
      <th scope="col">Kelas</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach ($ketuadata as $data )
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $data->ketua->nama }}</td>
      <td>{{ $data->kota->name }}, {{ $data->dob }}</td>
      <td>{{ $data->kelases->kelas }}</td>
      <td><a href="/dashboard/ketua/{{ $data->ketua->id }}" class="btn btn-primary">Detail</a></td>
    </tr>
  @endforeach
  </tbody>
</table>
  </div>
</div>
@endsection
