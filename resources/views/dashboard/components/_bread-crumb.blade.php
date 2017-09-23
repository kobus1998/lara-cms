<!--
@param Array $nav = all breadcrumbs
@param Array $nav->name = name of breadcrum
@param Array $nav->action = action of breadcrumb
-->


<div class="breadcrumb no-margin-left">
  <ul>
    @foreach ($navs as $nav)
      <li class="{{ ($nav['active']) ? 'is-active' : '' }}"><a href="{{ $nav['action'] }}">{{ $nav['name'] }}</a></li>
    @endforeach
  </ul>
</div>
