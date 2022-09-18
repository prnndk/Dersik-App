@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('icon')<i class="bi bi-exclamation-triangle fs-2 text-danger"></i>@endsection
@section('content')
<li class="d-flex gap-4">
    <i class="tutor bi bi-hdd-network"></i>
  <div>
    <h5 class="mb-0 ">Error Occured on server</h5>
    Please wait a second, and refresh again
  </div>
</li>
<li class="d-flex gap-4">
    <i class="tutor bi bi-telephone-outbound"></i>
  <div>
    <h5 class="mb-0 ">Keep entering this page?</h5>
    Contact us and tell what happened
  </div>
</li>
@endsection
