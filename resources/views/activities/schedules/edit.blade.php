@extends('layouts.app')
@section('title') {{ trans('page.schedules.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.schedules.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('schedules.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.schedules.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('schedules.update', $schedule->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <input type="hidden" name="program_id" id="program_id" value="{{ $schedule->program->id }}">

          <div class="mb-1">
            <label for="program_name" class="form-label">{{ trans('Kegiatan') }}</label>
            <input type="text" name="program_name" id="program_name" value="{{ old('program_name', $schedule->program->name) }}" class="form-control @error('program_name') is-invalid @enderror" readonly>
          </div>
          <div class="mb-4">
            <span class="text-muted fs-sm fw-semibold">{{ trans('Silahkan kembali ke halaman Kegiatan untuk melihat detailnya.') }}</span>
          </div>

          <div class="mb-4">
            <label for="type" class="form-label">{{ trans('Jadwal Kegiatan') }}</label>
            <input type="text" name="type" id="type" value="{{ old('type', $schedule->type) }}" class="form-control @error('type') is-invalid @enderror" readonly>
            @error('type')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="start_date">{{ trans('Tanggal Dimulai') }}</label>
            <input type="text" class="js-flatpickr form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $schedule->start_date) }}" placeholder="Y-m-d">
            @error('start_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-1">
            <label class="form-label" for="end_date">{{ trans('Tanggal Selesai') }}</label>
            <input type="text" class="js-flatpickr form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $schedule->end_date) }}" placeholder="Y-m-d">
            @error('end_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <span class="text-muted fs-sm fw-semibold">{{ trans('Jika form tanggal selesai tidak bisa diklik, silahkan untuk memasukkan atau mengubah tanggal selesai terlebih dahulu.') }}</span>
          </div>

          <div class="mb-4">
            <label for="status" class="form-label">{{ trans('Status Jadwal') }}</label>
            <select name="status" id="status" class="js-select2 form-select @error('status') is-invalid @enderror" data-placeholder="{{ trans('Pilih Status Jadwal') }}" style="width: 100%;">
              <option></option>
              @foreach ($statusScheduleTypes as $item)
                <option value="{{ $item }}" @if(old('status', $schedule->status) === $item) selected @endif>{{ trans($item) }}</option>
              @endforeach
            </select>
            @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
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
  @vite('resources/js/activities/schedules/form.js')
@endpush