@extends('layouts.app')

@section('content')

  <div class="has-margin-bottom">
    <div class="tabs">
      <ul>
        <li class=""><a href="{{ action('PageController@show', $page->id) }}">General</a></li>
        <li class="is-active"><a href="{{ action('PageController@showContent', $page->id) }}">Content</a></li>
        <li class=""><a href="{{ action('PageController@showSeo', $page->id) }}">SEO</a></li>
        <li><a target="_blank" href="{{ action('PageController@route', $page['url']) }}" class="button is-link">Visit</a></li>
      </ul>
    </div>
  </div>
  
  <div class="page-content">
    @include('dashboard/pages/forms/update-content')
  </div>


@endsection
