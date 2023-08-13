@extends('errors::layout')
@section('title', __('Halaman Tidak Ditemukan'))
@section('content')
  <div class="content content-full overflow-hidden">
    <div class="py-2">
      <!-- Error Header -->
      <h1 class="display-1 fw-bolder text-city">
        {{ trans('404') }}
      </h1>
      <h2 class="h4 fw-normal text-muted mb-5">
        {{ trans('Mohon maaf halaman yang anda cari tidak ditemukan..') }}
      </h2>
      <!-- END Error Header -->
    </div>
  </div>
@endsection
