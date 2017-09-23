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

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        @component('dashboard/components/_bread-crumb', ['navs' => [
            ['name' => 'Media', 'action' => action('MediaController@index'), 'active' => true]
          ]])

        @endcomponent
        {{-- <h4 class="title is-4 has-text-left">Media ({{$totalItems}})</h4> --}}
      </div>
    </div>
    <div class="level-right">
      <div class="level-item">
        <a
          @if ($getView == 'columns')
            href="{{ action('MediaController@index', ['view' => 'table', 's' => $searchQuery]) }}"
          @else
            href="{{ action('MediaController@index', ['view' => 'columns', 's' => $searchQuery]) }}"
          @endif

          class="button has-margin-right is-link">
          @if ($getView == 'table')
            Show images
          @else
            Show info
          @endif
        </a>
      </div>
    </div>
  </div>

  <div class="level">
    <div class="level-left has-margin-top">
      @component('dashboard/components/_upload') @endcomponent
    </div>
    <div class="level-right">
      @component('dashboard/components/_search', [
        'model' => $images,
        'searchQuery' => $searchQuery,
        'queries' => ['view' => $getView]
      ])
      @endcomponent
      @if ($getView == 'table')
        <button type="button" name="button" class="button is-danger delete-selected-media">delete Selected</button>
      @endif
    </div>
  </div>

  <hr>

  <div class="page-content">
    @component('dashboard/components/minis/_no-search-result', ['model' => $images])
    @endcomponent

    @if (count($images) == 0 && app('request')->input('s') == null)

      <div class="notification">
        <div class="content">
          <h4 class="title is-4">
            You don't have uploaded any media yet
            <a class="button is-primary is-pulled-right" href="{{ action('MediaController@upload') }}">Upload media</a>
          </h4>
        </div>
      </div>

    @elseif(count($images) != 0)

    <div class="media-manager">
      @if ($getView == 'columns')

        <!-- // -->

        <div class="columns is-multiline is-variable">
          @foreach ($images as $image)
            <div class="card box column is-one-third gap">
              <div class="card-image content-center">
                <img class="is-small image has-pointer" src="{{ $image['url'] }}" alt="">
              </div>
              <div class="card-content">
                <hr>
                <p><a href="{{ action('MediaController@show', $image['id']) }}">{{ $image['name'] }}</a></p>
              </div>
            </div>
          @endforeach
        </div>

        <!-- // -->

        <div class="modal has-margin-sidebar has-margin-header">
          <div class="modal-background"></div>
          <div class="modal-content width-auto">
            <img src="" class="image">
          </div>
          <button class="modal-close is-large has-margin-header" aria-label="close"></button>
        </div>

        <!-- // -->

      @elseif ($getView == 'table')

        <div class="columns table-media">

          <!-- // -->

          <form class="delete-media-form column is-9" action="{{ action('MediaController@delete') }}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="all-checkboxes has-pointer"></th>
                    <th>name</th>
                    <th class="is-hidden-mobile">created at</th>
                    <th></th>
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

      @endif

      </div>

    </div>

    <!-- // -->

    @component('dashboard/components/_pagination', [
      'model' => $images,
      'controller' => 'MediaController',
      'method' => 'index',
      'queries' => ['view' => $getView, 's' => $searchQuery]
    ])@endcomponent

    <!-- // -->

    @endif
@endsection
