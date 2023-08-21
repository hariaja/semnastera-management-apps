@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.users.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('users.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.users.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">
    <form action="{{ route('participants.store') }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
      @csrf

      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">

              <h2 class="content-heading pt-0">
                <i class="fa fa-fw fa-user-circle me-1"></i>
                {{ trans('Data Diri Anda') }}
              </h2>

              <hr class="">
              
              <div class="mb-3">
                <label for="first_title" class="form-label">{{ trans('Gelar Depan') }}</label>
                <input type="text" name="first_title" id="first_title" value="{{ old('first_title') }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
                @error('first_title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <label for="first_name" class="form-label">{{ trans('Nama Depan') }}</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
                @error('first_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
                @error('last_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-1">
                <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
                <input type="text" name="last_title" id="last_title" value="{{ old('last_title') }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
                @error('last_title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-4">
                <span class="text-muted fs-sm fw-semibold">{{ trans('Kosongkan jika tidak atau belum memiliki gelar') }}</span>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              
              <h2 class="content-heading pt-0">
                <i class="fa fa-fw fa-lock me-1"></i>
                {{ trans('Data Kredensial Anda') }}
              </h2>

              <hr class="">
    
              <div class="mb-4">
                <div class="alert alert-info d-flex align-items-center" role="alert">
                  <div class="flex-shrink-0">
                    <i class="fa fa-fw fa-info-circle"></i>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <p class="mb-0">
                      {{ trans('Jika anda melakukan tambah data pada halaman ini. Maka, password untuk akun tersebut secara default adalah') }}
                      <b>{{ trans('"password"') }}</b> {{ trans('tanpa tanda kutip.') }}
                    </p>
                  </div>
                </div>
              </div>
    
              <div class="mb-3">
                <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <label for="email" class="form-label">{{ trans('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <label for="roles" class="form-label">{{ trans('Tipe Akun') }}</label>
                <select name="roles" id="roles" class="js-select2 form-select @error('roles') is-invalid @enderror" data-placeholder="{{ trans('Pilih Tipe Akun') }}" style="width: 100%;">
                  <option></option>
                  @foreach ($roles as $item)
                    <option value="{{ $item->id }}" @if (old('roles') == $item->id) selected @endif>{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('roles')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="row justify-content-center mb-4">
            <div class="col-md-6">
    
              <h2 class="content-heading pt-0">
                <i class="fa fa-fw fa-globe me-1"></i>
                {{ trans('Infomasi Umum') }}
              </h2>

              <hr class="">
    
              <div class="mb-3">
                <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
                <select name="gender" id="gender" class="js-select2 form-select @error('gender') is-invalid @enderror" data-placeholder="{{ trans('Pilih Jenis Kelamin') }}" style="width: 100%;">
                  <option></option>
                  @foreach ($genderTypes as $gender)
                    <option value="{{ $gender }}" @if(old('gender') === $gender) selected @endif>{{ trans($gender) }}</option>
                  @endforeach
                </select>
                @error('gender')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <label for="institution" class="form-label">{{ trans('Asal Institusi') }}</label>
                <input type="text" name="institution" id="institution" value="{{ old('institution') }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
                @error('institution')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <div class="block block-rounded">
                  <div class="block-header block-header-default">
                    <label class="form-label">{{ trans('button.image') }}</label>
                  </div>
                  <div class="block-content">
                    <div class="push">
                      <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="mb-3">
                <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
                <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
                @error('avatar')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-4">
                <label class="form-label" for="address">{{ trans('Alamat Lengkap') }}</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address') }}</textarea>
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">
                <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                  {{ trans('button.create') }}
                </button>
              </div>
    
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>
</div>
@endsection