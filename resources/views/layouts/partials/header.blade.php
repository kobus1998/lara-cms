<nav class="nav has-shadow">
  <div class="container is-fluid">
    <div class="nav-left">
      <a href="" class="nav-item">Brand</a>
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
  </div>
</nav>
