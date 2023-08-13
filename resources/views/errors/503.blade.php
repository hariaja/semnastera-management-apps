@extends('errors::layout')
@section('title', __('Layanan Tidak Tersedia'))
@section('content')
  <div class="content content-full overflow-hidden">
    <div class="py-2">
      <!-- Error Header -->
      <h1 class="display-1 fw-bolder text-smooth">
        {{ trans('503') }}
      </h1>
      <h2 class="h4 fw-normal text-muted mb-5">
        {{ __('Mohon maaf layanan kami saat ini tidak tersedia..') }}
      </h2>
      <!-- END Error Header -->
    </div>
  </div>
@endsection

