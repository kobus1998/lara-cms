@extends('layouts.app')

@section('content')

  <div class="has-margin-bottom">
    <div class="tabs">
      <ul class="is-right">
        <li>
          <a class="button toggle-modal-create-collection">New Collection</a>
        </li>
        <li>
          <a class="no-link">
            @component('dashboard/components/_search', [
              'model' => $collections,
              'searchQuery' => app('request')->input('s'),
              ])@endcomponent
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="columns page-content">

    <div class="column">
      @component('dashboard/components/minis/_no-results', ['items' => $collections, 'name' => 'collections'])
        <form id="delete-multiple-collections-form" action="{{ action('CollectionController@setInactiveMultiple') }}" method="post">
          <input type="hidden" name="_method" value="PUT">
          {{ csrf_field() }}

          <table class="table table-striped">
            <thead>
              <tr>
                <th><input class="all-checkboxes" type="checkbox"></th>
                <th>Name</th>
                <th>Created At</th>
                <th><button class="button is-danger"><span class="icon is-small"><i class="fa fa-trash"></i></span></button></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($collections as $collection)
                <tr class="has-pointer show-box-data">
                  <td><input class="form-checkboxes" type="checkbox" name="ids[]" value="{{ $collection['id'] }}"></td>
                  <td><a href="{{ action('CollectionController@show', $collection['id']) }}">{{ $collection['name'] }}</a></td>
                  <td>{{ $collection['created_at'] }}</td>
                  <td></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </form>
      @endcomponent

    </div>

    @component('dashboard/components/minis/_modal', ['switchClass' => 'toggle-create-collection', 'position' => 'is-top'])
      @component('dashboard/collections/forms/create-collection')
      @endcomponent
    @endcomponent

  </div>

  @component('dashboard/components/_pagination', [
    'model' => $collections,
    'controller' => 'CollectionController',
    'method' => 'index',
    'queries' => ['s' => app('request')->input('s')]
  ])

  @endcomponent



@endsection
