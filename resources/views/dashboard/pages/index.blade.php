@extends('layouts.app')

@section('content')

  <div class="">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <h4 class="title is-4 has-text-left">Pages</h4>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <a href="{{ action('PageController@create') }}" class="button has-margin-right">New page</a>
          <form class="" action="index.html" method="post">
            <div class="field has-addons">
              <p class="control">
                <input type="text" name="search" value="{{ old('search') }}" class="input search" placeholder="Search page">
              </p>
              <p class="control">
                <button type="submit" class="button"><span class="icon is-small"><i class="fa fa-search"></i></span></button>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>

    <hr>

    @if (count($pages) == 0)

      <div class="notification">
        <div class="content">
          <h4 class="title is-4">
            You don't have any pages yet
            <a class="button is-primary is-pulled-right" href="{{ action('PageController@create') }}">Create a page</a>
          </h4>
        </div>
      </div>

    @else



    <form class="" action="{{ action('PageController@destroyMultiple') }}" method="post">
      <input type="hidden" name="_method" value="delete">
      {{ csrf_field() }}
      <table class="table table-striped is-striped">
        <thead>
          <tr>
            <th><span class="checkbox"><input class="all-checkboxes" type="checkbox"></span></th>
            <th>Name</th>
            <th>Url</th>
            <th>Type</th>
            <th>Last Modified</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pages as $page)
            <tr>
              <td><span class="checkbox"><input class="form-checkboxes" type="checkbox" name="pages[]" value="{{ $page['id'] }}"></span></td>
              <td><a href="{{ action('PageController@show', $page['id']) }}">{{ $page['name'] }}</a></td>
              <td><a target="_blank" href="{{ action('PageController@route', $page['url']) }}">{{ $page['url'] }}</a></td>
              <td><a href="">{{ $page['type']['name'] }}</a></td>
              <td>{{ $page['updated_at'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <div class="field">
              <p class="control">
                <button type="submit" class="button is-danger is-small delete-pages">Delete Selected</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </form>

    @endif

    @component('dashboard/components/_pagination', [
      'model' => $pages,
      'controller' => 'PageController',
      'method' => 'index'
    ])

    @endcomponent

  </div>

@endsection
