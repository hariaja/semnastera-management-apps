@extends('errors::layout')
@section('title', __('Unauthorized'))
@section('content')
  <div class="content content-full overflow-hidden">
    <div class="py-2">
      <!-- Error Header -->
      <h1 class="display-1 fw-bolder text-amethyst">
        {{ trans('401') }}
      </h1>
      <h2 class="h4 fw-normal text-muted mb-5">
        {{ __('Kami mohon maaf tetapi Anda tidak berwenang untuk mengakses halaman ini..') }}
      </h2>
      <!-- END Error Header -->
    </div>
  </div>
@endsection