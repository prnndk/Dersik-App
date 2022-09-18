@extends('dashboard.layouts.main')
@section('webtitle',$pemilihan->nama)
@section('container')
<div class="card">
    @if (session('token'))
    @if($token->vote_id!=$pemilihan->id)
            <div class="card-body">
                <h3 class="text-danger">Token anda hanya bisa digunakan pada {{$token->vote->nama}}</h3>
            </div>
    @else
    <div class="card-header">
        <h4>Selamat Datang Di {{$pemilihan->nama}}</h4>
        <div class="card-header-action">
            @if($token->user_id!=auth()->user()->id)
            <span>Anda menggunakan token <strong class="text-danger">{{ $token->user->name }}</strong></span>
            @else
            <span>Token Anda Terdaftar Sebagai <strong>{{ $token->user->name }}</strong></span>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3 class="text-center">{{$pemilihan->nama}}</h3>
                <p class="text-center">Vote Begin At {{\Carbon\Carbon::parse($pemilihan->mulai_coblos)->diffForHumans()}} sampai {{\Carbon\Carbon::parse($pemilihan->akhir_coblos)->diffForHumans()}}</p>
            </div>
        </div>
        <div class="row">
            @foreach ($ketua as $pilih )
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="{{ asset('storage/'.$pilih->img) }}" class="mx-auto d-block rounded" width="200" height="300" alt="{{ $pilih->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pilih->nama }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-success w-100 mt-2 lihat" data-show="{{$pilih->id}}">Detail</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary w-100 mt-2 yakin" data-id="{{$pilih->id}}" data-name="{{$pilih->nama}}">Pilih Ini</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            <button class="btn btn-danger w-50 mx-auto d-block out">Keluar dari Voting</button>
    </div>
        @endif
    @else
    <div class="card-header"><h4 class="text-danger">Anda Tidak Mempunyai Token!</h4></div>
        @endif
</div>

@endsection
@section('bawahsection')
<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Calon <span id="modalTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group mb-3">
                    <li class="list-group-item">Nama Lengkap: <span id="modalNama"></span> / <span id="modalPanggilan"></span></li>
                    <li class="list-group-item">TTL: <span id="modalTtl"></span>, <span id="modalTanggal"></span></li>
                    <li class="list-group-item">Pengalaman Organisasi: <span id="modalOrganisasi"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script>
    $(document).ready(function () {
        $('.yakin').click(function (e) {
            e.preventDefault();
            var calonid = $(this).attr('data-id');
            var nama = $(this).attr('data-name');
            Swal.fire({
                icon: "info",
                title: "Apakah Anda Yakin?",
                text: "Anda akan memilih " + nama + "",
                showCancelButton: true,
                confirmButtonColor: '#333eee',
                cancelButtonColor: '#FEC828',
                confirmButtonText: "Iya, Pilih " + nama + "",
                cancelButtonText: "Lihat Lagi deh",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location="/vote/simpan/"+calonid+""
                }
            });
        });
        $('.lihat').click(function (e){
            let data=$(this).attr('data-show')
            calonData();
            e.preventDefault();
            function calonData()
            {
                $.ajax({
                    type:'GET',
                    url:"/api/calon/"+data+"",
                    dataType:'json',
                    success:function (response) {
                        if (response.status == 200) {
                            $('#showModal').modal('show');
                            $('#modalNama').text(response.calon.ketua.nama)
                            $('#modalTtl').text(response.calon.kota.name)
                            $('#modalPanggilan').text(response.calon.ketua.panggilan)
                            $('#modalTanggal').text(response.calon.dob)
                            $('#modalOrganisasi').html(response.calon.pengalaman)
                        }
                        else
                        {
                            Swal.fire({
                                title:'Terjadi Kesalahan',
                                icon:'error',
                                text:'Data tidak ditemukan'
                            })
                        }
                    }
                });
            }
        })
        $('.out').click(function (e){
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda Yakin?',
                text: "Anda Akan keluar dan belum memilih",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Iya, Saya ingin keluar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location="{{route('logoutVote')}}"
                }
            })
        })
    })
</script>
@endsection

