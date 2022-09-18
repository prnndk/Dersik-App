@extends('dashboard.layouts.main')
@section('webtitle','Quickcount')
@section('container')
<div class="card">
  <div class="card-header">
    <h4>Hasil pemilihan {{ $vote->nama }}</h4>
    <div class="card-header-action">
      <a href="{{ route('vote') }}" class="badge badge-info text-decoration-none"><i class="fas fa-arrow-left"></i> Back to vote home</a>
    </div>
  </div>
    <div class="card-body">
    <canvas id="voteChart"></canvas>
    </div>
</div>
@endsection
@section('customjs')
<script>
var ctx = document.getElementById("voteChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
        @foreach ($data as $ketua )
            "{{ $ketua->nama }}",
        @endforeach
    ],
    datasets: [{
      label: 'Pemilih',
      data: [@foreach ($data as $num )
          "{{$num->suara}}",
      @endforeach],
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 1
        }
      }],
      xAxes: [{
        ticks: {
          display: false
        },
        gridLines: {
          display: false
        }
      }]
    },
  }
});
</script>
@endsection