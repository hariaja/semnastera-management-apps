@extends('layouts.app')
@section('title', trans('page.overview.title'))
@section('content')
<div class="row">
  <div class="col-6 col-md-3 col-lg-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="{{ checkPermission('users.index') ? route('users.index') : 'javascript:void(0)' }}">
      <div class="block-content block-content-full">
        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Semua Pengguna') }}</div>
        <div class="fs-2 fw-normal text-dark">
          {{ "{$user_count} Pengguna" }}
        </div>
      </div>
    </a>
  </div>
  <div class="col-6 col-md-3 col-lg-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="{{ checkPermission('programs.index') ? route('programs.index') : 'javascript:void(0)' }}">
      <div class="block-content block-content-full">
        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Acara Tersedia') }}</div>
        <div class="fs-2 fw-normal text-dark">
          {{ "{$program_count} Acara" }}
        </div>
      </div>
    </a>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-12">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          {{ trans('page.overview.title') }}
        </h3>
      </div>

      <div class="block-content block-content-full">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        {{ trans('You are logged in!') }}
      </div>
    </div>
  </div>
</div>
@endsection