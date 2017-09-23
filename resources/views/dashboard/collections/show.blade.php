@extends('layouts.app')

@section('content')

  <div class="page-content">

    <div class="level no-margin">
      <div class="level-left">
        <div class="level-item">
          @component('dashboard/components/_bread-crumb', ['navs' => [
              [
                'name' => 'Collections',
                'action' => action('CollectionController@index'),
                'active' => false,
              ], [
                'name' => $collection['name'],
                'action' => action('CollectionController@show', $collection['id']),
                'active' => true,
              ]
            ]])
          @endcomponent
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <a class="button has-margin-right toggle-modal-create-post">New Post</a>
        </div>
      </div>
    </div>

    <hr>

    <div class="page-content">

      <div class="columns">

        <div class="column is-3">
          @component('dashboard/collections/components/post-list', ['posts' => $posts, 'collection' => $collection])

          @endcomponent
        </div>

        <div class="column">

          <div class="tabs">
            <ul>
              <li class="is-active"><a href="{{ action('CollectionController@show', $collection['id']) }}">General</a></li>
              <li><a href="{{ action('CollectionController@edit', $collection['id']) }}">Manage fields</a></li>
            </ul>
          </div>

          <form class="has-padding" action="" method="post" style="background: white;">

            <h3 class="title">General</h3>

            <hr>

            <div class="field is-horizontal">
              <div class="field-label">
                <label for="name">Name</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" name="name" value="{{ $collection['name'] }}" class="input">
                  </div>
                </div>
              </div>
            </div>

            <div class="field is-horizontal">
              <div class="field-label">
                <label for="desc">Description</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <textarea class="textarea" name="desc" rows="8" cols="80">{{ $collection['desc'] }}</textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="field is-horizontal">
              <div class="field-label">
                <label for="all-pages">Include in all pages</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input @if($collection['all-pages'] == 1) checked @endif type="checkbox" name="all-pages" value="{{ $collection['all-pages'] }}" class="checkbox">
                  </div>
                </div>
              </div>
            </div>

            <div class="field is-horizontal">
              <div class="field-label">
                <label for=""></label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <button type="submit" class="button is-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>

      </div>


    </div>

  </div>

  @component('dashboard/components/minis/_modal', [
    'switchClass' => 'toggle-create-post',
    'position' => 'is-top'
  ])
    @component('dashboard/collections/forms/create-post', ['collection' => $collection])@endcomponent
  @endcomponent

@endsection
