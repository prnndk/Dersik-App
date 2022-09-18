@extends('dashboard.layouts.main')
@section('webtitle','Pendataan Alumni')
@section('container')
<div class="section-header">
    <h2>Pendataan Dersik 22</h2>
    <div class="section-header-breadcrumb">
        <a href="{{ route('pendataan.create') }}" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i> Buat Pendataan Baru</a>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->role=='admin')
            <div class="col-md-6">
                <div class="card-header">
                    <h4>Data by status</h4>
                </div>
                <canvas id="pendataan"></canvas>
            </div>
            @endif
        </div>
    </div>
@endsection
@section('customjs')
    <script>
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
