@extends('dashboard.layouts.main')
@section('webtitle','Scan Home')
@section('container')
    <div class="card">
        <div class="card-header">
            <h3>Data QR</h3>
        </div>
        <div class="card-body">
            <h5 class="text-danger">ALERT!! YOU MUST SCAN THE QR TO GET THE DATA</h5>
            <div class="row">
                <div class="col-4">
                    <a href="../dashboard/scan" class="btn btn-info">GO SCAN HERE</a>
                </div>
            </div>
        </div>
    </div>
@endsection
