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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Poppins" rel="stylesheet">
    <!-- END Fonts -->

    @include('components.style')

    <!-- Scripts -->
    @vite([])

  </head>

  <body>

    <div id="page-container" class="page-header-dark main-content-boxed">

      <a href="https://api.whatsapp.com/send?phone={{ Helper::ADMIN_CONTACT }}" class="float-custom" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Hubungi Admin">
        <i class="fab fa-whatsapp my-float"></i>
      </a>

      <!-- Header -->
      <header id="page-header">
        <!-- Header Content -->
        @include('partials.header')
        <!-- END Header Content -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary-lighter">
          <div class="content-header">
            <div class="w-100 text-center">
              <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
            </div>
          </div>
        </div>
        <!-- END Header Loader -->
      </header>
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        <!-- Navigation -->
        <div class="bg-primary-darker">
          <div class="bg-black-10">
            @include('partials.navigation')
          </div>
        </div>
        <!-- END Navigation -->
        <!-- Hero -->
        <div class="bg-body-light">
          @yield('hero')
        </div>
        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
          @yield('content')
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Footer -->
      <footer id="page-footer" class="bg-body-extra-light">
        @include('partials.footer')
      </footer>
      <!-- END Footer -->
    </div>

    <!-- JS -->
    @include('components.js')
  </body>
</html>