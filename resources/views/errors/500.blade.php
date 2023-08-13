@extends('errors::layout')
@section('title', __('Server Error'))
@section('content')
  <div class="content content-full overflow-hidden">
    <div class="py-2">
      <!-- Error Header -->
      <h1 class="display-1 fw-bolder text-modern">
        {{ trans('500') }}
      </h1>
      <h2 class="h4 fw-normal text-muted mb-5">
        {{ __('Kami mohon maaf tetapi server kami mengalami kesalahan internal..') }}
      </h2>
      <!-- END Error Header -->
    </div>
  </div>
@endsection
