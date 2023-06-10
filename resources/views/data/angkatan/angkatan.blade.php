@extends('dashboard.layouts.main')
@section('webtitle','Angkatan')
@section('container')
<div class="section-header">
    <h4>Data Angkatan</h4>
<div class="section-header-breadcrumb">
  <a href="/dashboard/angkatan/create" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Tambah Data</a>
</div>
</div>
  <div class="card">
    <div class="card-body">
    <table class="table table-responsive-md" id="table">
      <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Angkatan</th>
              <th scope="col">Tahun Angkatan</th>
              <th scope="col">Ketua Angkatan</th>
              <th scope="col">Actions</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($angkatan as $list )
        <tr>
         <td>{{ $loop->iteration }}</td>
         <td>{{ $list->nama }}</td>
         <td>{{ $list->tahun }}</td>
         <td>{{ $list->ketua }}</td>
         <td>
          <a href="/dashboard/angkatan/{{ $list->id }}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
          @if (auth()->user()->role=='admin')
          <a href="/dashboard/angkatan/{{ $list->id }}/edit" class="badge badge-warning mt-1"><i class="far fa-edit"></i></a>
          <form action="/dashboard/angkatan/{{ $list->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge badge-danger mt-1 border-0 deleteButton" data-name="{{ $list->nama }}"><i class="far fa-trash-alt"></i></button>
          </form>
          @endif
        </td>
        </tr>
        @endforeach
      </tbody>
  </table>
    </div>
  </div>

@endsection
@section('customjs')
  <script>
    $(document).ready(function() {
        $('.deleteButton').click(function (e) { 
            e.preventDefault();
            var name = $(this).attr('data-name');
            var form = $(this).closest("form");
            Swal.fire({
                title:'Apakah Anda Yakin?',
                text:'Anda akan melakukan penghapusan pada kelas '+name+' Beserta dengan seluruh user yang terkait',
                icon:"warning",
                confirmButtonText:'Ya, Hapuskan',
                showCancelButton:true,
                confirmButtonColor:'#d33',
            }).then((result)=>{
                if(result.isConfirmed){
                    Swal.fire('Deleting!','Deleting your data','info')
                    form.submit();
                }else{
                    Swal.fire('Cancelled!','Your data is safe','success')
                }
            })
        });
    });
  </script>
@endsection
