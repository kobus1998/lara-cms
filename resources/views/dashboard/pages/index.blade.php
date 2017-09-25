@extends('layouts.app')

@section('content')

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        @component('dashboard/components/_bread-crumb', ['navs' => [
            ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => true]
          ]])
        @endcomponent
      </div>
    </div>
    <div class="level-right">
      <div class="level-item">
        <a class="button is-primary toggle-modal-create-page has-margin-right">New page</a>
        @component('dashboard/components/_search', [
          'model' => $pages,
          'searchQuery' => app('request')->input('s'),
        ])@endcomponent
      </div>
    </div>
  </div>

  <hr>
  <div class="page-content">
    @component('dashboard/components/minis/_no-results', ['items' => $pages, 'name' => 'pages'])
      <form id="delete-pages-form" action="{{ action('PageController@setInactiveMultiple') }}" method="post">
        {{ csrf_field() }}

        <table class="table table-striped is-striped">
          <thead>
            <tr>
              <th><span class="checkbox"><input class="all-checkboxes" type="checkbox"></span></th>
              <th>Name</th>
              <th>Url</th>
              <th>Created at</th>
              <th><button type="submit" class="button is-danger is-small delete-pages">Delete Selected</button></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pages as $page)
              <tr>
                <td><span class="checkbox"><input class="form-checkboxes" type="checkbox" name="ids[]" value="{{ $page['id'] }}"></span></td>
                <td><a href="{{ action('PageController@show', $page['id']) }}">{{ $page['name'] }}</a></td>
                <td><a target="_blank" href="{{ action('PageController@route', $page['url']) }}">{{ $page['url'] }}</a></td>
                <td>{{ $page['created_at'] }}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </form>
    @endcomponent

      @component('dashboard/components/minis/_modal', ['switchClass' => 'toggle-create-page', 'position' => 'is-top'])
        @component('dashboard/pages/forms/create-page')
        @endcomponent
      @endcomponent

    </div>

    @component('dashboard/components/_pagination', [
      'model' => $pages,
      'controller' => 'PageController',
      'method' => 'index',
      'queries' => ['s' => app('request')->input('s')]
    ])@endcomponent

@endsection
