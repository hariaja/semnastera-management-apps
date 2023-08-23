@extends('layouts.app')
@section('title') {{ trans('page.roles.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.roles.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('roles.index') }}" class="btn btn-sm btn-block-option text-danger">
            <i class="fa fa-xs fa-chevron-left me-1"></i>
            {{ trans('button.back') }}
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.roles.edit') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('roles.update', $role->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
        @csrf
        @method('patch')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label class="form-label" for="name">{{ trans('Nama Peran') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Nama Peran Pengguna') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>

          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <div class="d-flex justify-content-between">
              <div class="space-y-2">
                <div class="form-check">
                  <input type="checkbox" name="all_permission" id="all_permission" class="form-check-input @error('permission') is-invalid @enderror">
                  <label for="all_permission" class="form-check-label">{{ trans('Pilih Semua Hak Akses') }}</label>
                  @error('permission')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="">
                <span class="text-muted">
                  {{ trans('Scroll untuk melihat lebih') }}
                </span>
              </div>
            </div>
          </div>
        </div>

      {{-- Row Block Content --}}
      <div class="row mb-4" id="data-temp"></div>

      <div class="ajax-load text-center" style="display:none">
        <i class="mdi mdi-48px mdi-spin mdi-loading"></i>
      </div>

      {{-- No Data When Scrolling Done --}}
      <div class="no-data mb-4" style="display:none">
        <h6 class="text-center">
          {{ trans('Kami tidak memiliki lebih banyak data untuk ditampilkan (Last Page)') }}
        </h6>
      </div>

        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="mb-3">
              <button type="submit" class="btn btn-primary w-100" id="submit-button">
                <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                {{ trans('button.edit') }}
              </button>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
@endsection
@push('javascript')
<script>
  window.translations = @json(trans('permission'));
</script>
@vite('resources/js/settings/roles/input.js')
@endpush