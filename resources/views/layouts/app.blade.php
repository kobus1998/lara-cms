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
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" charset="utf-8"></script>

</head>
<body>
  <div id="app" class="wrapper">

    <div class="header">
      @include('layouts/partials/header')
    </div>

    <div class="app-content">

      <div class="notification is-danger notification-error modified">
        <div class="content">
          <span class="text"></span>
          <span class="icon"><i class="fa fa-exclamation-triangle"></i></span>
        </div>
      </div>

      <div class="notification is-success notification-success modified">
        <div class="content">
          <span class="text"></span>
          <span class="icon"><i class="fa fa-check"></i></span>
        </div>
      </div>

      <div class="notification is-info notification-info modified">
        <div class="content">
          <span class="text"></span>
          <span class="icon"><i class="fa fa-info"></i></span>
        </div>
      </div>

      <div class="notification is-warning notification-warning modified">
        <div class="content">
          <span class="text"></span>
          <span class="icon"><i class="fa fa-exclamation"></i></span>
        </div>
      </div>

      <div class="notification notification-loading modified">
        <div class="content">
          <span class="text">Loading</span>
          <span class="icon"><i class="fa fa-spinner fa-pulse"></i></span>
        </div>
      </div>

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
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
</body>
</html>
