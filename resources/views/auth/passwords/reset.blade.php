@extends('layouts.guest')
@section('title', trans('Ubah Kata Sandi'))
@section('content')
<div class="hero-static d-flex align-items-center">
  <div class="w-100">
    <!-- Reminder Section -->
    <div class="bg-body-extra-light">
      <div class="content content-full">
        <div class="row g-0 justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
            <!-- Header -->
            <div class="text-center">
              <p class="mb-2">
                <img class="img-avatar" src="{{ asset('assets/images/polikami.png') }}" alt="">
              </p>
              <h1 class="h4 mb-1">
                {{ trans('Lupa Kata Sandi') }}
              </h1>
              <p class="fw-medium text-muted mb-3">
                {{ trans('Silahkan masukkan kata sandi baru anda pada form di bawah ini.') }}
              </p>
            </div>
            <!-- END Header -->

            @if (session('status'))
              @include('components.success')
            @endif

            <!-- Reminder Form -->
            <form method="POST" action="{{ route('password.update') }}" onsubmit="return disableSubmitButton()">
              @csrf

              <input type="hidden" name="token" value="{{ $token }}">

              <div class="py-3">
                <div class="mb-3">
                  <label for="email" class="form-label">{{ __('Email Address') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-control-lg form-control-alt" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
  
                <div class="mb-3 password-form">
                  <label for="password" class="form-label">{{ __('Password') }}</label>
                  <span class="text-danger">*</span>
                  <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror form-control-lg form-control-alt" id="password" name="password">
                    <span class="input-group-text">
                      <i class="far fa-eye-slash toggle-password" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Tampilkan Kata Sandi"></i>
                    </span>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
  
                <div class="mb-3 password-form">
                  <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
                  <span class="text-danger">*</span>
                  <div class="input-group">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror form-control-lg form-control-alt" id="password_confirmation" name="password_confirmation">
                    <span class="input-group-text">
                      <i class="far fa-eye-slash toggle-password" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Tampilkan Kata Sandi"></i>
                    </span>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                  <i class="fa fa-fw fa-check me-1"></i>
                  {{ trans('Reset Kata Sandi') }}
                </button>
              </div>

            </form>
            <!-- END Reminder Form -->

            <div class="text-center">
              <a class="fs-sm fw-medium" href="{{ route('login') }}">{{ trans('Masuk Aplikasi?') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END Reminder Section -->

    <!-- Footer -->
    <div class="fs-sm text-center text-muted py-3">
      <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
    <!-- END Footer -->

  </div>
</div>
@endsection
@push('css')
  @vite('resources/css/passwords/style.css')
@endpush