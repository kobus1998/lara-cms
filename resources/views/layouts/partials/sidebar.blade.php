<div class="sidebar menu {{ Auth::guest() ? 'is-hidden-tablet' : '' }}">
  @if (Auth::guest())
    <p class="menu-label"></p>
    <ul class="menu-list">
      <li><a class="nav-item is-tab {{ strpos(Request::path(), 'cms/login') !== false ? "is-active" : "" }}" href="{{ route('login') }}">Login</a></li>
      <li><a class="nav-item is-tab {{ strpos(Request::path(), 'cms/register') !== false ? "is-active" : "" }}" href="{{ route('register') }}">Register</a></li>
    </ul>
  @else
  <span class="is-hidden-tablet">
    <p class="menu-label"></p>
    <ul class="menu-list">
      <li>
        <a class="{{ strpos(Request::path(), 'cms/dashboard') !== false ? "is-active" : "" }}" href="{{ action('DashboardController@index') }}"><span class="icon is-small"><i class="fa fa-home"></i></span> Dashboard</a>
      </li>
    </ul>
  </span>
  <p class="menu-label">Client</p>
  <ul class="menu-list">
    <li><a class="{{ strpos(Request::path(), 'cms/page') !== false ? "is-active" : "" }}" href="{{ action('PageController@index') }}"><span class="icon is-small"><i class="fa fa-file-text-o"></i></span> Pages</a></li>
    <li><a class="{{ strpos(Request::path(), 'cms/collection') !== false ? "is-active" : "" }}" href="{{ action('CollectionController@index') }}"><span class="icon is-small"><i class="fa fa-folder"></i></span> Collections</a></li>
    <li><a class="{{ strpos(Request::path(), 'cms/media') !== false ? "is-active" : "" }}" href="{{ action('MediaController@index') }}"><span class="icon is-small"><i class="fa fa-image"></i></span> Media</a></li>
  </ul>
  <p class="menu-label">Developer</p>
  <ul class="menu-list">
    <li><a class="{{ strpos(Request::path(), 'cms/theme') !== false ? "is-active" : "" }}" href="{{ action('ThemeController@index') }}"><span class="icon is-small"><i class="fa fa-columns"></i></span> Themes</a></li>
    <li><a class="{{ strpos(Request::path(), 'cms/type') !== false ? "is-active" : "" }}" disabled href="#"><span class="icon is-small"><i class="fa fa-tag"></i></span> Types</a></li>
    <li><a class="{{ strpos(Request::path(), 'cms/user') !== false ? "is-active" : "" }}" disabled href="#"><span class="icon is-small"><i class="fa fa-user"></i></span> Users</a></li>
    <li><a class="{{ strpos(Request::path(), 'cms/settings') !== false ? "is-active" : "" }}" disabled href="#"><span class="icon is-small"><i class="fa fa-cog"></i></span> Settings</a></li>
  </ul>
  <span class="is-hidden-tablet">
    <p class="menu-label"></p>
    <ul class="menu-list">
      <li>
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span class="icon is-small"><i class="fa fa-sign-out"></i></span> Logout
        </a>
      </li>
    </ul>
  </span>
  @endif
</div>
