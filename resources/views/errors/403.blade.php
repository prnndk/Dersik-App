@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Directory is Forbidden'))
@section('icon')
<i class="bi bi-exclamation-octagon fs-2 text-danger"></i>
@endsection
@section('content')
<li class="d-flex gap-4">
    <i class="tutor bi bi-person-badge"></i>
  <div>
    <h5 class="mb-0 ">Check your Role</h5>
    Make Sure you're in right role, to access this page
  </div>
</li>
@endsection