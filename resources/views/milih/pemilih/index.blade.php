@extends('dashboard.layouts.main')
@section('webtitle','Data Pemilih')
@section('container')
    <div class="card">
        <div class="card-header">
            <h4>Data Pemilih</h4>
            <div class="card-header-action">
                <button class="badge badge-primary text-decoration-none border-0" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Generate User Token</button>
                <button class="badge badge-primary text-decoration-none border-0 " data-bs-toggle="modal" data-bs-target="#all"><i class="fas fa-people-group"></i> Generate all user</button>
                <button class="badge badge-primary text-decoration-none border-0 " data-bs-toggle="modal" data-bs-target="#angkatan"><i class="fas fa-people-group"></i> Generate by class</button>
            </div>
        </div>
    <div class="card-body">
        <table class="table table-responsive-md" id="table">
            <thead>
                <tr>
                    <th scope="col">Nama User</th>
                    <th scope="col">TOKEN</th>
                    <th scope="col">Pemilihan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilih as $p )
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->token }}</td>
                    <td>{{ $p->vote->nama }}</td>
                    <td>@if($p->status_pilih==0) <span class="badge badge-warning"> Belum Memilih</span> @elseif ($p->status_pilih==1) <span class="badge badge-success">Sudah Memilih</span> @endif</td>
                    <td>
                        <button class="badge badge-info border-0 mt-1" data-bs-toggle="modal" data-bs-target="#edit" data-bs-user="{{ $p->user }}"><i class="fas fa-edit"></i></button>
                        <button class="badge badge-danger mt-1 border-0" data-bs-toggle="modal" data-bs-target="#delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
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
                            <p>Menghapus Token User</p>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                            <form action="{{ route('pemilih.destroy',$p->id ) }}" role="form" method="post">
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
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @endsection
    {{-- Tambah Modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="tambah">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Generate User Vote Token</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pemilih.store') }}" role="form" method="post">
            @csrf
            <div class="form-group">
                <label for='user_id'>User</label>
                <select class="form-control selectric" required name='user_id' id="user">
                        <option value="" selected disabled>-Pilih User-</option>
                        @foreach ($user as $list)
                        @if (old('user_id')==$list->id)
                        <option value="{{ $list->id }}" selected>{{ $list->name }}</option>
                        @else
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @endif
                        @endforeach
                </select>
                @error('user_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <label for='vote_id'>Pemilihan</label>
                <select class="form-control selectric" required name='vote_id' id="vote_id">
                        <option value="" selected disabled>-Pemilihan-</option>
                        @foreach ($vote as $v)
                        @if (old('vote_id')==$v->id)
                        <option value="{{ $v->id }}" selected>{{ $v->nama }}</option>
                        @else
                        <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Tambahkan Data</button>
        </div>
            </form>
        </div>
        </div>
    </div>
    {{-- Generate to all user --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="all">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Generate token to all user</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('generateAll') }}" role="form" method="post">
            @csrf
            <div class="form-group">
                <label for='vote_id'>Pemilihan</label>
                <select class="form-control selectric" required name='vote_id' id="vote_id">
                        <option value="" selected disabled>-Pemilihan-</option>
                        @foreach ($vote as $v)
                        @if (old('vote_id')==$v->id)
                        <option value="{{ $v->id }}" selected>{{ $v->nama }}</option>
                        @else
                        <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Generate token to all user</button>
        </div>
            </form>
        </div>
        </div>
    </div>
    {{-- Generate by angkatan --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="angkatan">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Generate token to specific class</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('generateAngkat') }}" role="form" method="post">
            @csrf
            <div class="form-group">
                <label for='kelas_id'>Pilih Kelas</label>
                <select class="form-control selectric" required name='kelas_id' id="kelas_id">
                        <option value="" selected disabled>-Pilih Kelas-</option>
                        @foreach ($kelas as $kls)
                        @if (old('kelas_id')==$kls->id)
                        <option value="{{ $kls->id }}" selected>{{ $kls->kelas }}</option>
                        @else
                        <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                        @endif
                        @endforeach
                </select>
                <label for='vote_id'>Pemilihan</label>
                <select class="form-control selectric" required name='vote_id' id="vote_id">
                        <option value="" selected disabled>-Pemilihan-</option>
                        @foreach ($vote as $v)
                        @if (old('vote_id')==$v->id)
                        <option value="{{ $v->id }}" selected>{{ $v->nama }}</option>
                        @else
                        <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Generate token to specific class</button>
        </div>
            </form>
        </div>
        </div>
    </div>
    {{-- edit Modal --}}
    {{-- <div class="modal fade" tabindex="-1" role="dialog" id="edit">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Detail Status</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pemilih.store') }}" role="form" method="post">
            @csrf

        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Tambahkan Data</button>
        </div>
            </form>
        </div>
        </div>
    </div> --}}
