<nav class="nav has-shadow">

    <div class="nav-left">
      <a href="/cms" class="brand">{{ config('app.name') }}</a>
      <span class="nav-item">
        @isset($navs)
          @component('dashboard/components/_bread-crumb', ['navs' => $navs])
          @endcomponent
        @endisset
      </span>
    </div>
    <div class="nav-right nav-menu">
      @if (Auth::guest())
        <a class="nav-item is-tab {{ strpos(Request::path(), 'cms/login') !== false ? "is-active" : "" }}" href="{{ route('login') }}">Login</a>
        <a class="nav-item is-tab {{ strpos(Request::path(), 'cms/register') !== false ? "is-active" : "" }}" href="{{ route('register') }}">Register</a>
      @else
        <a class="nav-item is-tab {{ strpos(Request::path(), 'cms/dashboard') !== false ? "is-active" : "" }}" href="{{ action('DashboardController@index') }}">Dashboard</a>
        <a class="nav-item is-tab" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      @endif
    </div>
    <span class="toggle-sidebar nav-item is-hidden-tablet has-pointer">
      <span class="icon">
        <i class="fa fa-ellipsis-v "></i>
      </span>
    </span>
</nav>
