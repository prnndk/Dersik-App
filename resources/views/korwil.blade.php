@extends('layouts.home')
@section('container')
    <h4 class="section-title">Data Koordinator Wilayah DERSIK 22</h4>
  <div class="card card-primary mt-3">
    <div class="card-body">
        <table class="table table-responsive-md" id="table">
            <thead>
                <tr>
                    <th scope="col">Kota</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
            @foreach($korwils as $korwil)
              <tr>
                <td>{{$korwil->kota->name}}</td>
                <td>{{$korwil->PJ}}</td>
                <td><a href="/detail" class="badge badge-info"><i class="far fa-eye"></i></a></td>
              </tr>
            @endforeach
            </tbody>
        </table>
    </div>
  </div>
@endsection
