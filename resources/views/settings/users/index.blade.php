@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.users.title') }}</h1>
    </div>
  </div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.users.index') }}
    </h3>
    <div class="block-options">
      @canany(['users.create', 'participants.create'])
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-block-popin">
          <i class="fa fa-plus fa-xs me-1"></i>
          {{ trans('page.users.create') }}
        </button>
      @endcan
    </div>
  </div>
  <div class="block-content">

    <div class="row">
      <div class="col-md-4">
        <div class="mb-4">
          <label for="status" class="form-label">{{ trans('Filter Status') }}</label>
          <select type="text" class="form-select" name="status" id="status">
            <option value="{{ Helper::ALL }}">{{ Helper::ALL }}</option>
            @foreach ($statusUserTypes as $item)
              <option value="{{ $item }}">{{ $item ? ucfirst('Active') : ucfirst('Inactive') }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-1">
          <label for="roles" class="form-label">{{ trans('Filter Peran') }}</label>
          <select type="text" class="form-select" name="roles" id="roles">
            <option value="{{ Helper::ALL }}">{{ Helper::ALL }}</option>
            @foreach ($roleTypes as $item)
              <option value="{{ $item }}">{{ ucfirst($item) }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="my-3">
      {{ $dataTable->table() }}
    </div>

  </div>
</div>

@includeIf('components.create-user')
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  <script>
    var urlStatus = "{{ route('users.status', ':uuid') }}"
    var urlDestroy = "{{ route('users.destroy', ':uuid') }}"
  </script>
  @vite('resources/js/settings/users/index.js')
@endpush