@extends('dashboard.layouts.main')
@section('webtitle','Data Status')
@section('container')
    <div class="section-header">
        <h2>Data Status</h2>
    <div class="section-header-breadcrumb">
        {{-- <a href="" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Buat Data Status</a> --}}
        <button class="btn btn-primary text-decoration-none" id="tambah"><i class="fas fa-plus"></i> Tambah Status</button>
    </div>
    </div>

<div class="card">
    <div class="card-body">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id</th>
                    <th scope="col">Nama status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($status as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>
                    <button class="badge badge-warning mt-1 border-0 editbutton" id="editbutton" data-id="{{$s->id}}"><i class="far fa-edit"></i></button>
                    <button class="badge badge-danger mt-1 border-0" data-bs-toggle="modal" data-bs-target="#delete"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('bawahsection')

{{-- Tambah MODAL --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Detail Status</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('status.store') }}" role="form" method="post" autocomplete="off">
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Status</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"  required value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="submit" class="btn btn-primary">Tambahkan Data</button>
    </div>
    </form>
    </div>
    </div>
</div>
{{-- Edit MODAL --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Edit Nama Status</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form role="form">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Status</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="namaedit" name="nama"  required value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button id="submitEdit" class="btn btn-primary">Tambahkan Data</button>
    </div>
        </form>
    </div>
    </div>
</div>
@endsection
@section('customjs')
<script>
$(document).ready(function (){
$('#tambah').click(function (e){
    e.preventDefault();
    $('#tambahModal').modal('show');
});
$('.editbutton').click(function (){
    let id = $(this).data('id');
    getdata();
    function getdata()
    {
        $.ajax({
            type:'GET',
            url:'/data/status/'+id+'',
            dataType:'json',
            success:function (response){
                $('#editModal').modal('show'),
                    $('#namaedit').val(response.data.nama),
                    $('#submitEdit').click(function (){
                        let data=$('#namaedit').val();
                        $.ajax({
                            type: 'post',
                            method:'update',
                            data:{nama: data},
                            url:'/data/status/'+id+''
                        })
                    })
            },
            error:function (xhr){
                Swal.fire({
                    title:'Terjadi Kesalahan',
                    text:'Ada kesalahan saat fetch data',
                    icon:'error'
                })
            }
        })
    }
})
})
</script>
@endsection
