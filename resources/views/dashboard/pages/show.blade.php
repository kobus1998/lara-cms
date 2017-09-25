@extends('layouts.app')

@section('content')

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        @component('dashboard/components/_bread-crumb', ['navs' => [
            ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
            ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => true]
          ]])
        @endcomponent
      </div>
    </div>
    <div class="level-right">
      <div class="level-item">
      </div>
    </div>
  </div>
  <hr>
  <nav>
    <div class="tabs toggle-parent">
      <ul>
        <li data-toggle="general-tab" class="btn-toggle is-active"><a>General</a></li>
        <li data-toggle="content-tab" class="btn-toggle"><a>Content</a></li>
        <li data-toggle="seo-tab" class="btn-toggle"><a>SEO</a></li>
        <li>
          <a target="_blank" href="{{ action('PageController@route', $page['url']) }}" class="button is-link">Visit</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="page-content">
    <div class="toggle-content">
      @include('dashboard/pages/forms/update-general')
      @include('dashboard/pages/forms/update-content')
      @include('dashboard/pages/forms/update-seo')
    </div>
  </div>


@endsection
