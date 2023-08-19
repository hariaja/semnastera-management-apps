@extends('layouts.app')
@section('title') {{ trans('page.programs.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.programs.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('programs.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.programs.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('programs.update', $program->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label class="form-label" for="name">{{ trans('Nama Kegiatan Seminar') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $program->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="location">{{ trans('Lokasi atau Tempat Kegiatan') }}</label>
            <input type="text" name="location" id="location" value="{{ old('location', $program->isLocation()) }}" class="form-control @error('location') is-invalid @enderror" required placeholder="{{ trans('etc. Kampus Politeknik SMI') }}">
            @error('location')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="responsible">{{ trans('Nama Penanggung Jawab atau Ketua Pelaksana') }}</label>
            <input type="text" name="responsible" id="responsible" value="{{ old('responsible', $program->responsible) }}" class="form-control @error('responsible') is-invalid @enderror" required>
            @error('responsible')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="mb-4">
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