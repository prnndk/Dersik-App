@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('icon')<i class="bi bi-arrow-clockwise fs-2 text-info"></i>@endsection
@section('content')
<li class="d-flex gap-4">
    <i class="tutor bi bi-bootstrap-reboot"></i>
  <div>
    <h5 class="mb-0 ">Please refresh this page</h5>
    This often happen if you left the web to long
</div>
</li>
<li class="d-flex gap-4">
    <i class="tutor bi bi-unlock"></i>
  <div>
    <h5 class="mb-0 ">Or go to login page</h5>
    Check are u already logged in
  </div>
</li>
@endsection