@extends('errors::layout')
@section('title', __('Akses Terlarang'))
@section('content')
  <div class="content content-full overflow-hidden">
    <div class="py-2">
      <!-- Error Header -->
      <h1 class="display-1 fw-bolder text-flat">
        {{ trans('403') }}
      </h1>
      <h2 class="h4 fw-normal text-muted mb-5">
        {{ __($exception->getMessage() ?: 'Kami mohon maaf tetapi Anda tidak memiliki izin untuk mengakses halaman ini..') }}
      </h2>
      <!-- END Error Header -->
    </div>
  </div>
@endsection
