@extends('dashboard.layouts.main')
@section('webtitle','Regis Email')
@section('container')
<div class="section-header"><h2>Registrasi Email smasa.id</h2>
<div class="section-header-breadcrumb">
  <a href="/dashboard/regis-mail/create" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Create New</a>
</div>
</div>
<div class="card">
  <div class="card-header"><h4>List Requested Mail</h4></div>
    <div class="card-body">
      <table class="table table-responsive-md" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Requested Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (auth()->user()->role=='User')
          @foreach ($index as $list )
          <tr>
           <td>{{ $loop->iteration }}</td>
           <td>{{ $list->nama }}</td>
           <td>{{ $list->email}}<span>@</span>{{ $list->domain->name }}</td>
           @if ($list->status == "Dalam Peninjauan")
           <td class="badge badge-info mt-2">{{ $list->status }}</td>
           @elseif ($list->status =="Ditolak")
           <td class="badge badge-danger mt-2">{{ $list->status }}</td>
           @else
           <td class="badge badge-success mt-2">{{ $list->status }}</td>
           @endif
           <td>
            <a href="/dashboard/regis-mail/{{ $list->id }}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
            <a href="/dashboard/regis-mail/{{ $list->id }}/edit" class="badge badge-warning mt-1"><i class="far fa-edit"></i></a>
            <button class="badge badge-danger mt-1 border-0 delete" data-id="{{$list->id}}" ><i class="far fa-trash-alt"></i></button>
          </td>
          </tr>
          @endforeach
          @elseif(auth()->user()->role=='admin')
          @foreach ($admin as $min )
          <tr>
           <td>{{ $loop->iteration }}</td>
           <td>{{ $min->nama }}</td>
           <td>{{ $min->email}}<span>@</span>{{ $min->domain->name }}</td>
           @if ($min->status == "Dalam Peninjauan")
           <td class="badge badge-info mt-2">{{ $min->status }}</td>
           @elseif ($min->status =="Ditolak")
           <td class="badge badge-danger mt-2">{{ $min->status }}</td>
           @else
           <td class="badge badge-success mt-2">{{ $min->status }}</td>
           @endif
           <td>
            <a href="/dashboard/regis-mail/{{ $min->id }}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
            <a href="/dashboard/regis-mail/{{ $min->id }}/edit" class="badge badge-warning mt-1"><i class="far fa-edit"></i></a>
            <button class="badge badge-danger mt-1 border-0 delete" data-id="{{$min->id}}" ><i class="far fa-trash-alt"></i></button>
          </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
</div>
</div>
@endsection
@section('bawahsection')
    {{-- Delete Modal --}}
    <div class="modal fade"tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anda Yakin?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus calon dengan nama </p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="" role="form" method="post">
                        @method('delete')
                        @csrf
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $('.delete').click(function (){
            let id=$(this).attr('data-id')
            Swal.fire({
                icon:'warning',
                title:'Apakah Anda yakin?',
                text:'Permohonan ini akan dihapus',
                showCloseButton:true,
                showCancelButton:true,
                confirmButtonText:'Hapus Data',
                confirmButtonColor:'#fc2626',
                cancelButtonColor:'#00ffa0'
            }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    type:'post',
                    method:'delete',
                    url:'/dashboard/regis-mail/'+id+'',
                    data:{
                        '_token':"{{csrf_token()}}"
                    },
                })
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            }
            })
        })
    </script>
@endsection
