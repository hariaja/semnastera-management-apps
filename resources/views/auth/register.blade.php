@extends('layouts.guest')
@section('title', trans('page.register.title'))
@section('content')
  <!-- Page Content -->
  <div class="hero-static d-flex align-items-center">
    <div class="w-100">
      <!-- Sign In Section -->
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
                  {{ trans('Buat Akun Baru') }}
                </h1>
                <p class="text-muted mb-4">
                  {{ trans('Dapatkan akses Anda hari ini dalam satu langkah mudah') }}
                </p>
              </div>
              <!-- END Header -->

              <!-- Sign In Form -->
              <form action="{{ route('register') }}" method="POST" onsubmit="return disableSubmitButton()">
                @csrf

                <div class="mb-1">
                  <span class="h5">{{ trans('Personalia') }}</span>
                </div>
                
                <div class="mb-3">
                  <input type="text" name="first_title" id="first_title" value="{{ old('first_title') }}" class="form-control form-control-lg form-control-alt @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
                  @error('first_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control form-control-lg form-control-alt @error('first_name') is-invalid @enderror" placeholder="{{ trans('Nama Depan') }}" onkeypress="return hanyaHuruf(event)">
                  @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control form-control-lg form-control-alt @error('last_name') is-invalid @enderror" placeholder="{{ trans('Nama Belakang') }}" onkeypress="return hanyaHuruf(event)">
                  @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-2">
                  <input type="text" name="last_title" id="last_title" value="{{ old('last_title') }}" class="form-control form-control-lg form-control-alt @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Belakang') }}" onkeypress="return hanyaHuruf(event)">
                  @error('last_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <span class="text-muted fs-sm fw-semibold">{{ trans('Kosongkan jika tidak atau belum memiliki gelar') }}</span>
                </div>

                <div class="mb-1">
                  <span class="h5">{{ trans('Informasi Umum') }}</span>
                </div>

                <div class="mb-3">
                  <select name="roles" id="roles" class="js-select2 form-select @error('roles') is-invalid @enderror" data-placeholder="{{ trans('Pilih Tipe Akun') }}" style="width: 100%;">
                    <option></option>
                    @foreach ($roles as $item)
                      @if (old('roles') == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                      @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('roles')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control form-control-lg form-control-alt @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <select name="gender" id="gender" class="js-select2 form-select @error('gender') is-invalid @enderror" data-placeholder="{{ trans('Pilih Jenis Kelamin') }}" style="width: 100%;">
                    <option></option>
                    <option value="Laki - Laki" {{ old('gender') === GenderType::MALE->value ? 'selected' : '' }}>{{ GenderType::MALE->value }}</option>
                    <option value="Perempuan" {{ old('gender') === GenderType::FEMALE->value ? 'selected' : '' }}>{{ GenderType::FEMALE->value }}</option>
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <input type="text" name="institution" id="institution" value="{{ old('institution') }}" class="form-control form-control-lg form-control-alt @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
                  @error('institution')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <textarea name="address" id="address" class="form-control form-control-lg form-control-alt @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address') }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-1">
                  <p class="h5 mb-0">{{ trans('Kredensial') }}</p>
                  <span class="text-muted">{{ trans('Jangan berikan Informasi ini kepada Siapapun!') }}</span>
                </div>

                <div class="mb-3">
                  <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control  form-control-lg form-control-alt @error('password') is-invalid @enderror" placeholder="{{ trans('Password') }}">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control  form-control-lg form-control-alt @error('password_confirmation') is-invalid @enderror" placeholder="{{ trans('Ulangi Password') }}">
                  @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-4">
                  <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                    <i class="fa fa-fw fa-plus me-1"></i>
                    {{ trans('Buat Akun') }}
                  </button>
                </div>

                <div class="fs-sm text-center text-muted py-3">
                  <span>{{ trans('Sudah memiliki akun?') }}</span>
                  <a href="{{ route('login') }}"><strong>{{ trans('Masuk Aplikasi Disini') }}</strong></a>
                </div>

              </form>
              <!-- END Sign In Form -->

            </div>
          </div>
        </div>
      </div>
      <!-- END Sign In Section -->

      <!-- Footer -->
      <div class="fs-sm text-center text-muted py-3">
        <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
      </div>
      <!-- END Footer -->
    </div>
  </div>
  <!-- END Page Content -->
@endsection