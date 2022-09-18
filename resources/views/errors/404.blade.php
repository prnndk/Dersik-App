@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('icon')<i class="bi bi-exclamation-triangle fs-2 text-danger"></i>@endsection
@section('content')
<li class="d-flex gap-4">
    <i class="tutor bi bi-spellcheck"></i>
  <div>
    <h5 class="mb-0 ">Have you check your spelling?</h5>
    Incase your typing is typo, make sure enter corret spelling
  </div>
</li>
@endsection
