@extends('layouts.app')

@section('content')

  <div class="overview">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <h4 class="title is-4 has-text-left">Pages</h4>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <form class="" action="index.html" method="post">
            <div class="field has-addons">
              <p class="control">
                <input type="text" name="search" value="{{ old('search') }}" class="input search">
              </p>
              <p class="control">
                <button type="submit" class="button"><span class="icon is-small"><i class="fa fa-search"></i></span></button>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>

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
              <td><a href="{{ action('PageController@show', $page['id']) }}">{{ $page['page_name'] }}</a></td>
              <td><a href="{{ action('PageController@show', $page['id']) }}">{{ $page['url'] }}</a></td>
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



  </div>

@endsection
