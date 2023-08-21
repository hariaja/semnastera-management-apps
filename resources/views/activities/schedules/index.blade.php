@extends('layouts.app')
@section('title') {{ trans('page.schedules.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.schedules.title') }}</h1>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.schedules.index') }}
      </h3>
      <div class="block-options">
        @can('schedules.create')
          <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus fa-xs me-1"></i>
            {{ trans('page.schedules.create') }}
          </a>
        @endcan
      </div>
    </div>
    <div class="block-content">

      <div class="my-3">
        {{ $dataTable->table() }}
      </div>

    </div>
  </div>
  @includeIf('activities.schedules.show')
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  @vite('resources/js/activities/schedules/script.js')
  <script>
    var urlShow = "{{ route('schedules.show', ':uuid') }}"
    var urlDestroy = "{{ route('schedules.destroy', ':uuid') }}"
  </script>
@endpush