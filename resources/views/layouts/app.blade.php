<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
  <div id="app" class="wrapper">

    <div class="header">
      @include('layouts/partials/header')
    </div>

    <div class="app-content">

        @if (Auth::guest())
          @include('layouts/partials/sidebar')
          <div class="overview">
            @yield('content')
          </div>
        @else
          @include('layouts/partials/sidebar')
          <div class="has-sidebar overview">
            @if (\Session::has('danger'))
              <div class="notification is-danger">
                {{ \Session::get('danger') }}
              </div>
            @elseif (\Session::has('success'))
              <div class="notification is-success">
                {{ \Session::get('success') }}
              </div>
            @endif

            @yield('content')
          </div>
        @endif


      </div>
    </div>

  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
