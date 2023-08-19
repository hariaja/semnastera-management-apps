@extends('layouts.app')
@section('title', trans('Info Profil Saya'))
@section('hero')
  <div class="bg-image" style="background-image: url({{ asset('assets/src/media/photos/photo12@2x.jpg') }});">
    <div class="bg-primary-dark-op">
      <div class="content content-full text-center">
        <div class="my-3">
          <img class="img-avatar img-avatar-thumb" src="{{ $user->userAvatar() }}" alt="">
        </div>
        <h1 class="h2 text-white mb-0">{{ $user->name }}</h1>
        <h2 class="h4 fw-normal text-white-75">
          {{ $user->isRoleName() }}
        </h2>
        <a class="btn btn-alt-secondary" href="{{ route('home') }}">
          <i class="fa fa-fw fa-arrow-left text-danger me-1"></i>
          {{ trans('Back to Dashboard') }}
        </a>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="content content-full content-boxed">
  <div class="block block-rounded">
    <div class="block-content">

      <form action="{{ route('participants.update', $user->participant->uuid) }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

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
                  <input type="text" name="first_title" id="first_title" value="{{ old('first_title', $participant->first_title) }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
                  @error('first_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-3">
                  <label for="first_name" class="form-label">{{ trans('Nama Depan') }}</label>
                  <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $participant->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
                  @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-3">
                  <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
                  <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $participant->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
                  @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-1">
                  <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
                  <input type="text" name="last_title" id="last_title" value="{{ old('last_title', $participant->last_title) }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
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
                        {{ trans('Jika akun anda berasal atau dibuatkan admin dan belum sama sekali mengganti kata sandi, silahkan ganti kata sandi anda secara rutin dan bila mana anda tidak mengetahui kata sandi default pada aplikasi ini, silahkan masukkan') }}
                        <b>{{ trans('"password"') }}</b> {{ trans('tanpa tanda kutip.') }}
                      </p>
                    </div>
                  </div>
                </div>
      
                <div class="mb-3">
                  <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
                  <input type="text" name="phone" id="phone" value="{{ old('phone', $participant->user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-3">
                  <label for="email" class="form-label">{{ trans('Email') }}</label>
                  <input type="email" name="email" id="email" value="{{ old('email', $participant->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}" readonly>
                  @error('email')
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

                <input type="hidden" name="roles" value="{{ $user->isRoleId() }}">
      
                <div class="mb-3">
                  <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
                  <select name="gender" id="gender" class="js-select2 form-select @error('gender') is-invalid @enderror" data-placeholder="{{ trans('Pilih Jenis Kelamin') }}" style="width: 100%;">
                    <option></option>
                    @foreach ($genderTypes as $gender)
                      <option value="{{ $gender }}" @if(old('gender', $participant->gender) === $gender) selected @endif>{{ trans($gender) }}</option>
                    @endforeach
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-4">
                  <label for="institution" class="form-label">{{ trans('Asal Institusi') }}</label>
                  <input type="text" name="institution" id="institution" value="{{ old('institution', $participant->institution) }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
                  @error('institution')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-3">
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <label class="form-label">{{ trans('button.image') }}</label>
                      <div class="block-options">
                        <a href="javascript:void(0)" data-uuid="{{ $user->uuid }}" class="text-danger delete-user-image"><i class="fas fa-trash"></i></a>
                      </div>
                    </div>
                    <div class="block-content">
                      <div class="push">
                        @isset($participant->user->avatar)
                          <img class="img-prev img-profile-center" src="{{ $participant->user->userAvatar() }}" alt="">
                        @else
                          <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                        @endisset
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
                  <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address', $participant->address) }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="mb-3">
                  <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                    {{ trans('button.edit') }}
                  </button>
                </div>
      
              </div>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection
@push('javascript')
  <script>
    var urlDeleteImage = "{{ route('users.image', ':uuid') }}"
  </script>
  @vite('resources/js/settings/users/index.js')
@endpush