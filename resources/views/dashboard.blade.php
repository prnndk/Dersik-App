@extends('dashboard.layouts.main')
@section('webtitle','Dashboard')
@section('container')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="col-12 mb-4">
        <div class="hero text-{{ $text }} hero-bg-image" data-background="{{ asset('storage/app-image/'.$gambar) }}">
            <div class="hero-inner">
                <i class="bi {{ $icon }} fs-2"></i>
                <h2>{{ $greet }}, {{ auth()->user()->username }}</h2>
                <p class="lead">Selamat datang di aplikasi DERSIK 22</p>
                <div class="mt-4">
                    <a href="/user/profile" class="text-{{ $text }} fs-5 text-decoration-none">Manage my account <i
                            class="fas fa-arrow-right fs-5"></i></a>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role=='admin')
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Registered User</h4>
                        </div>
                        <div class="card-body">
                            {{DB::table('users')->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pemohon Email</h4>
                        </div>
                        <div class="card-body">
                            {{DB::table('regis_emails')->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Isi pendataan</h4>
                        </div>
                        <div class="card-body">
                            {{ $siswa }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-people-group"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Data pemilih</h4>
                        </div>
                        <div class="card-body">
                            {{ $voter }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Baris dua --}}
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kelas terdata</h4>
                        </div>
                        <div class="card-body">
                            {{$count = DB::table('kelas')->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Angkatan terdata</h4>
                        </div>
                        <div class="card-body">
                            {{DB::table('angkatans')->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="far fa-file-word"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Korwil terdata</h4>
                        </div>
                        <div class="card-body">
                            {{ DB::table('korwils')->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-info"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Informasi</h4>
                        </div>
                        <div class="card-body">
                            {{ DB::table('informasis')->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="section-body">
        <h2 class="section-title">Pengumuman dan Informasi</h2>
        <p class="section-lead">Pengumuman terbaru DERSIK 2022</p>
    </div>

    {{-- card row --}}
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-6 mt04">
            @if ($info)
                <div class="card card-info">
                    <div class="card-header">
                        <h4>{{ $info->judul }}</h4>
                        <div class="card-header-action">
                            <span
                                class="badge badge-info text-decoration-none border-0">{{ $info->kateginfo->name }}</span>
                            <span
                                class="badge badge-warning text-decoration-none border-0">{{ $info->angkat->nama }}</span>
                        </div>
                    </div>
                    <img src="{{ asset('storage/'.$info->img) }}" class="mx-auto rounded" height="150" width="300"
                         alt="{{ $info->judul }}">
                    <div class="card-body">
                        {!! $info->body !!}
                    </div>
                </div>
            @else
                <div class="card card-info">
                    <div class="card-header">
                        <h4>Tidak ada Informasi / Pengumumuman</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center font-italic">Belum ada informasi yang dapat ditampilkan</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-12 col-sm-12 col-lg-6 mt-04">
            <div class="card card-hero">
                <div class="card-header">
                    <div class="card-icon"><i class="far fa-calendar-days"></i></div>
                    <h4>Agenda</h4>
                    <div class="card-description">
                        Daftar agenda yang akan dilaksanakan
                    </div>
                </div>
                <div class="card-body">
                    @foreach($agendas as $agenda)
                    <div class="media">
                        <div class="media-body">
                            <div class="float-right text-sm">{{$agenda->tanggal.":".$agenda->waktu}}</div>
                            <h6 class="media-title text-primary font-italic">{{$agenda->nama}}</h6>
                            <div class="media-description">Pelaksanaan di {{$agenda->tempat}}</div>
                            <a href="{{route('agenda.show',$agenda->id)}}" class="btn btn-sm btn-outline-primary px-3 my-1">Detail Agenda</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Quick Link</h4>
                </div>
                <div class="card-body">
                    @foreach ($button as $btn )
                        <div class="btn-group m-1">
                            <a href="{{ $btn->route }}" class="btn btn-{{Str::lower($btn->btn_color)}}"><i
                                    class="{{ $btn->icon }}"></i> {{ $btn->nama }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
{{--            birthday--}}
            <div class="card">
                <div class="card-header">
                    <h4>Happy Birthday to you!</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        @foreach($birthdays as $birthday)
                            <li class="media">
                                <div class="media-body">
                                    <div class="float-right text-primary">Today</div>
                                    <div class="media-title">{{$birthday->name}}</div>
                                    <span class="text-small text-muted">Selamat ulang tahun untukmu, semoga selalu diberi kemudahan dan kelancaran dalam segala hal🤩🤩🤗</span>
                                </div>
                        @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
