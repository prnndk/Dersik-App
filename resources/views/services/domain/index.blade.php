@extends('dashboard.layouts.main')
@section('webtitle','Data Domain')
@section('container')
    <div class="section-header">
        <h3>Daftar Domain Angkatan</h3>
        <div class="section-header-breadcrumb">
            <a href="/dashboard/domain/create" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Make New</a>
        </div>
    </div>
<div class="card">
    <div class="card-body">
    <table class="table table-responsive-md" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Domain</th>
                <th scope="col">PJ</th>
                <th scope="col">Angkatan</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($domain as $list )
          <tr>
           <td>{{ $loop->iteration }}</td>
           <td><a href="https://{{ $list->name }}">{{ $list->name }}</a></td>
           <td>{{ $list->pj }}</td>
           <td>{{ $list->angkatan->nama }}</td>
           <td>
               <form method="POST" class="delete" action="">
                @method('delete')
                @csrf
            <a href="/dashboard/domain/{{ $list->id }}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
            <button type="submit" data-id="{{ $list->id }}" class="badge badge-danger mt-1 border-0 delete-confirm"><i class="far fa-trash-alt"></i></button>
            </form>
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
    $('.delete-confirm').on('click', function (e) {
    e.preventDefault();
    const id =$(this).attr("data-id");
    const form = $('.delete');
    $('form').attr('action', '/dashboard/domain/'+id+'');
    swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Data domain ini akan dihapus',
        icon: 'warning',
        showCloseButton:true,
        showCancelButton:true,
        confirmButtonText: 'Ya, Hapus Data',
    }).then(result=> {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>
@endsection
