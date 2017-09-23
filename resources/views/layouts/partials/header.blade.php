<nav class="nav has-shadow">

    <div class="nav-left">
      <a href="" class="brand">Brand</a>
      <span class="nav-item">{{ $title or '' }}</span>
    </div>
    <div class="nav-right nav-menu">
      @if (Auth::guest())
        <a class="nav-item is-tab" href="{{ route('login') }}">Login</a>
        <a class="nav-item is-tab" href="{{ route('register') }}">Register</a>
      @else
        <a class="nav-item is-tab" href="{{ action('DashboardController@index') }}">Dashboard</a>
        <a class="nav-item is-tab" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      @endif
    </div>
    <span class="toggle-sidebar nav-item is-hidden-tablet">
      <span class="icon">
        <i class="fa fa-ellipsis-v "></i>
      </span>
    </span>
</nav>
