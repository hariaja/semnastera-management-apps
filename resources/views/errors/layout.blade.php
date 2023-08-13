<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/polikami.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/src/css/oneui.min.css') }}" id="css-main">
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
              @yield('content')
            </div>
            <div class="content content-full text-muted fs-sm fw-medium">
              <!-- Error Footer -->
              <p class="mb-1">
                {{ trans('Apakah Anda ingin memberi tahu kami tentang hal itu?') }}
              </p>
              <a class="link-fx" href="https://api.whatsapp.com/send?phone={{ Helper::ADMIN_CONTACT }}">{{ trans('Laporkan') }}</a> {{ trans('atau') }} <a class="link-fx" href="{{ route('home') }}">{{ trans('Kembali ke Beranda') }}</a>
              <!-- END Error Footer -->
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!-- JS -->
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
  </body>
</html>
