@extends('dashboard.layouts.main')
@section('webtitle','Daftar Voting')
@section('container')
    <div class="section-header">
        <h2>Voting Admin</h2>
        <div class="section-header-breadcrumb">
            <a href="{{route('voting.create')}}" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> New Voting</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive-md" id="table">
                <thead>
                <tr>
                    <th scope="col">Nama Voting</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Akhir</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

            @foreach($data as $vote)
                <tr>
                    <td>{{$vote->nama}}</td>
                    <td>{{$vote->angkatan->nama}}</td>
                    <td>{{$vote->mulai_coblos}}</td>
                    <td>{{$vote->akhir_coblos}}</td>
                    <td>
                        <button class="badge badge-danger border-0 mt-1" data-bs-toggle="modal" data-bs-target="#delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                </tbody>
                @section('bawahsection')
                    {{-- Delete MODAL --}}
                    <div class="modal fade" tabindex="-1" role="dialog" id="delete">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Menghapus {{ $vote->nama }}?</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin ingin menghapus voting {{ $vote->nama }}</p>
                                </div>
                                <div class="modal-footer bg-whitesmoke br">
                                    <form action="{{ route('voting.destroy',$vote->id ) }}" role="form" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Yes delete Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
{{--                    deleteModal End--}}
                @endsection
            @endforeach
            </table>

        </div>
    </div>
@endsection
