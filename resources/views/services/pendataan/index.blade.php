@extends('dashboard.layouts.main')
@section('webtitle','Pendataan Alumni')
@section('container')
<div class="section-header">
    <h2>Pendataan Dersik 22</h2>
    <div class="section-header-breadcrumb">
        <a href="{{ route('pendataan.create') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Buat Pendataan Baru</a>
    </div>
</div>
<div class="row">
  @if (auth()->user()->role=='admin')
  <div class="col-md-6">
  <div class="card">
      <div class="card-header">
          <h4>Data by status</h4>
      </div>
      <div class="card-body">
        <canvas id="pendataan"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
    <div class="card-header"><h4>Statisctic Of Pendataan</h4></div>
      <div class="card-body">
        <div class="stat my-2">
          <h5>Most class filling form</h5>
          <div class="text-small float-right font-weight-bold text-muted">{{ $mostclass->count }}</div>
          <div class="font-weight-bold mb-1">{{ $mostclass->kls->kelas }}</div>
          <div class="progress" data-height="3" style="height: 3px;">
            <div class="progress-bar" role="progressbar" data-width="{{ ($mostclass->count/$jmldata)*100 }}%" aria-valuenow="{{ $mostclass->count }}" aria-valuemin="0" aria-valuemax="{{ $jmldata }}" style="width: {{ ($mostclass->count/$jmldata)*100 }}%;"></div>
          </div>
        </div>
        <div class="stat my-2">
          <h5>Most domicile</h5>
          <div class="text-small float-right font-weight-bold text-muted">{{ $mostcity->count }}</div>
          <div class="font-weight-bold mb-1">{{ $mostcity->kab->name }}</div>
          <div class="progress" data-height="3" style="height: 3px;">
            <div class="progress-bar" role="progressbar" data-width="{{ ($mostcity->count/$jmldata)*100 }}%" aria-valuenow="{{ $mostcity->count }}" aria-valuemin="0" aria-valuemax="{{ $jmldata }}" style="width: {{ ($mostcity->count/$jmldata)*100 }}%;"></div>
          </div>
        </div>
        <div class="stat my-2">
          <h5>Most Agency/Univ</h5>
          <div class="text-small float-right font-weight-bold text-muted">{{ $mostuni->count }}</div>
          <div class="font-weight-bold mb-1">{{ $mostuni->instansi }}</div>
          <div class="progress" data-height="3" style="height: 3px;">
            <div class="progress-bar" role="progressbar" data-width="{{ ($mostuni->count/$jmldata)*100 }}%" aria-valuenow="{{ $mostuni->count }}" aria-valuemin="0" aria-valuemax="{{ $jmldata }}" style="width: {{ ($mostuni->count/$jmldata)*100 }}%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header"><h4>List of responden</h4><div class="card-header-action"><a class="btn btn-primary" href="{{ route('pendataan.create') }}">Add data</a></div></div>
      <div class="card-body">
        <table class="table table-responsive-md" id="table">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">Kelas</th>
              <th scope="col">Status Sekarang</th>
              <th scope="col">Detail Status</th>
              <th scope="col">Accepted</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($admin as $data )
            <tr>
              <td>{{ $data->nama }}</td>
              <td>{{ $data->kls->kelas }}</td>
              <td>{{ $data->sttus->nama }}</td>
              <td>{{ $data->instansi }}</td>
              <td>@if($data->review==0)<span class="badge badge-warning">On Review</span>@elseif ($data->review==1)<span class="badge badge-success">Accepted</span>@elseif($data->review==2)<span class="badge badge-danger">Rejected</span>@endif</td>
              <td>
                <div class="dropdown"><a href="#" class="dropdown-toggle badge badge-primary" data-toggle="dropdown"><i class="fas fa-list"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="{{ route('pendataan.show',$data->id) }}" class="dropdown-item has-icon"><i class="far fa-eye"></i> View</a>
                  <a href="{{ route('pendataan.edit',$data->id) }}" class="dropdown-item has-icon"><i class="fas fa-pencil"></i> Edit</a>
                  <button class="dropdown-item has-icon btn btn-icon-left" id="delete" data-form-id="{{ $data->id }}"><i class="fas fa-trash"></i> Delete</button>
                </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      </div>
    </div>
  @elseif(auth()->user()->role=='User')
  <div class="col-md-8">
    <div class="card">
      <div class="card-header"><h4>Your submission</h4></div>
      <div class="card-body">
          @foreach ($datum as $data )
          <div class="text-small float-right font-weight-bold text-muted">Submitted {{ $data->created_at->diffForHumans() }}</div>
          <h6>{{ $data->nama }}</h6>
          @if($data->review==0)<span class="badge badge-warning">On Review</span>@elseif ($data->review==1)<span class="badge badge-success">Accepted</span>@elseif($data->review==2)<span class="badge badge-danger">Rejected</span>@endif
          <div class="table-responsive table-invoice my-2">
            <table class="table table-hover">
              <tbody><tr>
                <th>Kelas</th>
                <th>Status</th>
                <th>Instansi</th>
                <th>Detail Jurusan / Pekerjaan</th>
              </tr>
              <tr data-href="{{ route('pendataan.show',$data->id) }}">
                <td>{{ $data->kls->kelas }}</td>
                <td>{{ $data->sttus->nama }}</td>
                <td>{{ $data->instansi }}</td>
                <td>{{ $data->detail_status }}</td>
              </tr>
            </tbody></table>
          </div>
          @endforeach
        </div>
      </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header"><h4>Statistic</h4></div>
      <div class="card-body">

      </div>
    </div>
  </div>
  @endif
</div>
@endsection
<style>
  [data-href] {
    cursor: pointer;
}
</style>
@section('customjs')
<script>
$(document).ready(function($) {
  $('*[data-href]').on('click', function() {
    window.location = $(this).data("href");
  });
  $('#delete').on('click',function(){
    var id = $(this).data('form-id');
    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Data yang sudah dihapus tidak dapat dikembalikan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Ya, hapus data!",
      cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ url('/pendataan') }}/"+id,
          type: "POST",
          data: {
          '_method': 'DELETE',
          '_token': "{{ csrf_token() }}"
          },
          success: function(response){
            Swal.fire({
              title: "Berhasil!",
              text:''+response.message+'',
              icon: "success",
            });
          window.location.href = "{{ url('/pendataan') }}";
          },
          error: function(data){
            Swal.fire("Data gagal dihapus", {
              icon: "error",
            });
          }
        });
      } else {
        Swal.fire({
          icon:'info',
          title:'Data tidak jadi dihapus',
          text:'Data anda aman',
          showCloseButton: true,
        });
      }
    });
  });
});
    var ctx = document.getElementById("pendataan").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    datasets: [{
      data: [
        {{ $cs1 }},
        {{ $cs2 }},
        {{ $cs3 }},
        {{ $cs4 }},
      ],
      backgroundColor: [
        '#191d21',
        '#63ed7a',
        '#ffa426',
        '#fc544b',
        '#6777ef',
      ],
      label: 'Dataset 1'
    }],
    labels: [
      'Bekerja',
      'Kuliah',
      'Gapyear',
      'Kedinasan',
    ],
    },
    options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
    }
    });
    </script>
@endsection
