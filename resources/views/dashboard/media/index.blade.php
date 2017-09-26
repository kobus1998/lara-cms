@extends('layouts.app')

@section('content')

  @php
    $getView = app('request')->input('view');
    $searchQuery = app('request')->input('s');
    $totalItems =  $images->total();

    if ($searchQuery == null) {
      $searchQuery = '';
    }

    if (empty($getView)) {
      $getView = 'table';
    }
  @endphp

  <div class="has-margin-bottom">
    <div class="tabs is-white">
      <ul>
      </ul>
      <ul class="is-right">
        <li>
          <a class="no-link">@component('dashboard/components/_search', [
            'model' => $images,
            'searchQuery' => $searchQuery,
            'queries' => ['view' => $getView]
          ])@endcomponent</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="has-padding is-white has-margin-bottom">
    @component('dashboard/components/_upload') @endcomponent
  </div>

  <!-- // -->
  @component('dashboard/components/minis/_no-results', ['items' => $images, 'name' => 'medias'])
    <div class="page-content">
      <!-- // -->
      <div class="media-manager">
        <!-- // -->
        <div class="columns table-media">
          <div class="column is-9">
            <form class="delete-media-form" action="{{ action('MediaController@delete') }}" method="post">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="all-checkboxes has-pointer"></th>
                      <th>name</th>
                      <th class="is-hidden-mobile">created at</th>
                      <th><button type="submit" class="button is-danger delete-selected-media is-small"><span class="icon is-small"><i class="fa fa-trash"></i></span></button></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($images as $image)
                      <tr class="has-pointer show-image-sidebar" url="{{ action('MediaController@show', $image['id']) }}" src="{{ $image['url'] }}" name="{{ $image['name'] }}" img-id="{{ $image['id'] }}">
                        <td><input type="checkbox" class="form-checkboxes has-pointer" name="images[]" value="{{ $image->id }}"></td>
                        <td class=""><a href="{{ action('MediaController@show', $image['id']) }}">{{ $image['name'] }}</a></td>
                        <td class="is-hidden-mobile">{{ $image['created_at'] }}</td>
                        <td><span class="icon"><i class="fa fa-arrow-right"></i></span></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </form>
          </div>
          <!-- // -->
          <div class="column">
            <form class="" action="{{ action('MediaController@delete') }}" method="post">
              <input type="hidden" name="_method" value="delete">
              {{ csrf_field() }}
              <div class="modal is-mobile-only">
                <div class="modal-background"></div>
                <div class="modal-content">
                  <div class="box">
                    <img src="" alt="" class="media-enlarged image">
                    <hr>
                    <input type="hidden" name="images[]" value="" class="image-id selected-img">
                    <div class="level">
                      <div class="level-left">
                        <a href="#" class="image-name break-all"></a>
                      </div>
                      <div class="level-right">
                        <button type="submit" class="button is-danger hidden btn-remove-media"><span class="icon"><i class="fa fa-trash"></i></span></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <!-- // -->

        </div>

      </div>

    </div>

    <!-- // -->

    @component('dashboard/components/_pagination', [
      'model' => $images,
      'controller' => 'MediaController',
      'method' => 'index',
      'queries' => ['view' => $getView, 's' => $searchQuery]
    ])@endcomponent

  @endcomponent

@endsection
