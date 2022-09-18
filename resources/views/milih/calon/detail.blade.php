@extends('dashboard.layouts.main')
@section('webtitle','Detail '.$ketua->panggilan)
@section('container')
<div class="section-header"><h2>Detail data ketua {{ $ketua->nama }}</h2></div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('storage/'.$ketua->img) }}" class="rounded" width="200" height="300" alt="">
            </div>
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item">Nama Lengkap: {{ $ketua->nama }} / {{ $ketua->panggilan }}</li>
                    @foreach ($detail as $d )
                    <li class="list-group-item">Instagram: {{ $d->ig }}</li>
                    <li class="list-group-item">TTL: {{ $d->kota->name }}, {{ $d->dob }}</li>
                    <li class="list-group-item">Pengalaman Organisasi: <br>{!! $d->pengalaman !!}</li>
                    @endforeach
                </ul>
            <a href="/dashboard/ketua" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back To Daftar Ketua</a>
            @if(auth()->user()->role=='admin')
                <a href="{{route('ketua.edit',$ketua->id) }}" class="btn btn-warning"><i class="fas fa-pencil"></i> Edit this data</a>
                <button class="btn btn-danger border-0" data-bs-toggle="modal" data-bs-target="#delete"><i class="far fa-trash-alt"></i> Delete</button>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
{{--    <script>--}}
{{--        $('.delete').click(function (){--}}
{{--            Swal.fire({--}}
{{--                icon:'warning',--}}
{{--                title:'Arya Gading Prinandika',--}}
{{--                showCancelButton:true,--}}
{{--                cancelButtonColor:'#ffea04',--}}
{{--                cancelButtonText:'Batal Hapus',--}}
{{--                confirmButtonColor:'#D40000FF',--}}
{{--                confirmButtonText:'Hapus Data Ketua'--}}
{{--            }).then((result) => {--}}
{{--            if (result.isConfirmed) {--}}
{{--                window.location="{{route('ketua.destroy',$ketua->id)}}"--}}
{{--                --}}{{--$.ajax({--}}
{{--                --}}{{--    type:'post',--}}
{{--                --}}{{--    url:'{{route('ketua.destroy',$ketua->id)}}',--}}
{{--                --}}{{--    data:{--}}
{{--                --}}{{--        '_token':"{{csrf_token()}}",--}}
{{--                --}}{{--        '_method':'delete'--}}
{{--                --}}{{--    }--}}
{{--                --}}{{--})--}}
{{--            }--}}
{{--        });--}}
{{--        })--}}
{{--    </script>--}}
@endsection
@section('bawahsection')
    {{-- Delete Modal --}}
    <div class="modal fade"tabindex="-1" role="dialog" id="delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anda Yakin?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus calon dengan nama {{$ketua->nama}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('ketua.destroy',$ketua->id ) }}" role="form" method="post">
                        @method('delete')
                        @csrf
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

