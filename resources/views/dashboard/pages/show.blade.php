@extends('layouts.app')

@section('content')

  <div class="container is-fluid">

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

    <br>
    <div class="toggle-content">

      @include('dashboard/pages/forms/update-general')
      @include('dashboard/pages/forms/update-content')
      @include('dashboard/pages/forms/update-seo')
      @include('dashboard/pages/forms/add-content')

    </div>
  </div>

@endsection
