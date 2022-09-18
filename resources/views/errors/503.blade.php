@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('icon')<i class="bi bi-cloud-slash fs-2 text-warning"></i>@endsection
@section('content')
<li class="d-flex gap-4">
    <i class="tutor bi bi-bootstrap-reboot"></i>
  <div>
    <h5 class="mb-0 ">Error Contacting Server</h5>
    Wait for 5-10 minute and refresh this page
</div>
</li>
<li class="d-flex gap-4">
    <i class="tutor bi bi-toggle2-on"></i>
  <div>
    <h5 class="mb-0 ">Under Maintenance Mode</h5>
    Or this website is under maintenance by owner
</div>
</li>
@endsection
