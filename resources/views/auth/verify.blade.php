<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('Verifikasi Email') }} | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/polikami.png') }}">
    <!-- END Icons -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Poppins" rel="stylesheet">
    <!-- END Fonts -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/src/css/oneui.min.css') }}" id="css-main">
    <link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
    <!-- END Stylesheets -->

    @vite([])
  </head>

  <body>
    <!-- Page Container -->
    <div id="page-container">

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="hero">
          <div class="hero-inner text-center">
            <div class="bg-body-extra-light">
              <div class="content content-full overflow-hidden">
                <div class="py-4">

                  <p class="mb-2">
                    <img class="img-square-center" src="{{ asset('assets/images/mail.png') }}" alt="" width="5%">
                  </p>

                  @if(session('resent'))
                    <div class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="my-4">
                          <div class="alert alert-success d-flex align-items-center" role="alert">
                            <div class="flex-shrink-0">
                              <i class="fa fa-fw fa-check"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <p class="mb-0">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif

                  <!-- Error Header -->
                  <h4 class="fw-bolder text-city mb-0">
                    {{ __('Verifikasi Alamat Email Anda') }}
                  </h4>
                  <h2 class="h4 fw-normal text-muted mb-0">
                    {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                  </h2>
                  <h2 class="h4 fw-normal text-muted mb-5">
                    {{ __('If you did not receive the email, Silahkan tekan tombol di bawah untuk mengirim ulang permintaan Verifikasi Anda.') }}
                  </h2>

                  <form method="POST" action="{{ route('verification.resend') }}" onsubmit="return disableSubmitButton()">
                    @csrf

                    <div class="row justify-content-center">
                      <div class="col-md-6">

                        <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                          <i class="fa fa-fw fa-circle-check me-1"></i>
                          {{ trans('page.login.title') }}
                        </button>

                      </div>
                    </div>

                  </form>

                  <!-- END Error Header -->
                </div>
              </div>
            </div>
            <div class="content content-full text-muted fs-sm fw-medium">
              <!-- Error Footer -->
              <p class="mb-0">
                {{ trans('Anda mengalami kesulitan?') }}
              </p>
              <a class="link-fx" href="https://api.whatsapp.com/send?phone={{ Helper::ADMIN_CONTACT }}">
                {{ trans('Hubungi Admin Disini.') }}
              </a>
              <!-- END Error Footer -->
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!-- JS  -->
    <script src="{{ asset('assets/src/js/oneui.app.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
  </body>
</html>