<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SMASA BLITAR 2022</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
{{--  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">--}}
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/stisla/css/style.css">
  <link rel="stylesheet" href="/stisla/css/components.css">
  <link rel="stylesheet" href="/css/custom.css">
  <link rel="stylesheet" href="/fas/css/all.min.css ">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="card card-info">
        <div class="card-header">
            <a href="/" class="btn btn-icon-sm"><i class="fas fa-home"></i></a>
            <h4>Form isian pendataan {{ $data->nama }}</h4>
            <div class="card-header-action">
                <span class="badge badge-primary">{{ $data->angkat->nama }}</span>
                @if($data->pengajuan==0)<span class="badge badge-info">Pengajuan baru</span>@elseif($data->pengajuan==1) <span class="badge badge-info">Pengajuan ulang</span> @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group mb-2">
                        <li class="list-group-item">Nama: {{ $data->nama }}</li>
                        <li class="list-group-item">Email: {{ $data->email }}</li>
                        <li class="list-group-item">Kelas: {{ $data->kls->kelas }}</li>
                        <li class="list-group-item">Status: {{ $data->sttus->nama }}</li>
                        <li class="list-group-item">Tempat Status: {{ $data->instansi }}</li>
                        <li class="list-group-item">Detail Status: {{ $data->detail_status }}</li>
                        <li class="list-group-item">Kota Domisili: {{ $data->kab->name }}</li>
                        <li class="list-group-item">Nomor Hp: +62{{ $data->nomor }}</li>
                        <li class="list-group-item">Teman Satu Domisili: <span class="fw-bold">{{ $data->teman_smasa }}</span> @if($data->banyak_teman) Banyaknya: {{ $data->banyak_teman }} @endif</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group mb-2">
                        <li class="list-group-item">Status data: @if($data->review==0)<span class="badge badge-warning">On Review</span>@elseif ($data->review==1)<span class="badge badge-success">Accepted</span>@elseif($data->review==2)<span class="badge badge-danger">Rejected</span>@endif</li>
                        @if($data->review==2)
                        <li class="list-group-item">Alasan ditolak: {{ $data->message }}</li>
                        @endif
                        <li class="list-group-item">{!! QrCode::size(150)->generate('https://dersik.smasa.id/pendataan/cek/'.$data->url) !!}</li>
                        <li class="list-group-item">Terimakasih telah mengisi pendataan alumni SMAN 1 Blitar, Setiap update akan dikirim melalui email anda yang telah terdaftar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <div class="simple-footer"> Copyright &copy; {{ date('Y') }} Made with 💙 by <a href="https://dersik.smasa.id">SMASA DERSIK 22</a></div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="/stisla/js/stisla.js"></script>

<!-- Template JS File -->
<script src="/stisla/js/scripts.js"></script>
</body>
</html>
