@extends('layouts.app')

@section('content')

  <div class="level no-margin">
    <div class="level-left">
      <div class="level-item">
        @component('dashboard/components/_bread-crumb', ['navs' => [
            [
              'name' => 'Collections',
              'action' => action('CollectionController@index'),
              'active' => true
            ]
          ]])

        @endcomponent
      </div>
    </div>
    <div class="level-right">
      <div class="level-item">
        <a class="button has-margin-right toggle-modal-create-collection">New Collection</a>
        @component('dashboard/components/_search', [
          'model' => $collections,
          'searchQuery' => app('request')->input('s'),
        ])@endcomponent
      </div>
    </div>
  </div>

  <hr>

  <div class="columns page-content">

    <div class="column">
      <table class="table table-striped">
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th>Name</th>
            <th>Posts</th>
            <th>Created at</th>
            <th>All pages</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($collections as $collection)
            <tr class="has-pointer show-box-data">
              <td><input type="checkbox" name="id[]" value="{{ $collection['id'] }}"></td>
              <td><a href="{{ action('CollectionController@show', $collection['id']) }}">{{ $collection['name'] }}</a></td>
              <td>{{ count($collection['posts']) }}</td>
              <td>{{ $collection['created_at'] }}</td>
              <td><input @if ($collection['all-pages'] == 1) checked @endif type="checkbox" name="all-pages" value="{{ $collection['all-pages'] }}"></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  @component('dashboard/components/_pagination', [
    'model' => $collections,
    'controller' => 'CollectionController',
    'method' => 'index',
    'queries' => ['s' => app('request')->input('s')]
  ])

  @endcomponent

  @component('dashboard/components/minis/_modal', [
    'switchClass' => 'toggle-create-collection',
    'position' => 'is-top'
  ])
    @component('dashboard/collections/forms/create-collection')
    @endcomponent
  @endcomponent



@endsection
