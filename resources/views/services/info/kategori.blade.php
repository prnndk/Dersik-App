@extends('dashboard.layouts.main')
@section('container')
<div class="card">
    <div class="card-header">
        <h4>Buat Kategori Informasi</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('kategInfoStore') }}" method="post" role="form">
        @csrf
        <div class="form-group col-md-8">
            <label for="name">Nama Kategori</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i> Send Data</button>
        </form>
    </div>
</div>
<div class="row">

@foreach ($kateg as $k )
<div class="col-md-4">
    <div class="card card-warning">
        <div class="card-header">
            <h4>{{ $k->name }}</h4>
        </div>
        <div class="card-body">
            <button class="btn btn-sm btn-warning border-0 edit" data-id="{{ $k->id }}" data-name="{{ $k->name }}"><i class="fas fa-pencil"></i> Edit this kategori</button>
            <button class="btn btn-sm btn-danger border-0 delete" data-id="{{ $k->id }}"><i class="fas fa-trash"></i> Delete this data</button>
        </div>
    </div>
</div>
@endforeach
</div>
@endsection
<div class="modal fade" tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit data</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" id="form" role="form" method="post">
            @method('PUT')
            @csrf
            <div class="form-group col-md-12">
                <label for="name">Nama Kategori</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Edit this data</button>
        </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete this data</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <form action="" id="form" role="form" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Delete this data</button>
        </div>
            </form>
        </div>
    </div>
</div>
@section('customjs')
<script>
    $(".edit").click(function (e) { 
        e.preventDefault();
        const id = $(this).data("id");
        const name = $(this).data("name");
        $('#edit').modal('show');
        $("#name").val(name);
        $('form').attr('action', '/info/kategori/'+id+'');
    });
    $(".delete").click(function (e) { 
        e.preventDefault();
        const id = $(this).data("id");
        $('#delete').modal('show');
        $('form').attr('action', '/info/kateg/delete/'+id+'');
    });
</script>
@endsection