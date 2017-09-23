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
                'active' => false,
              ], [
                'name' => $currentPost['name'],
                'action' => action('CollectionController@showPost', ['collectionId' => $collection['id'], 'postId' => $currentPost['id']]),
                'active' => true
              ]
            ]])
          @endcomponent
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          {{-- <a href="{{ action('PageController@create') }}" class="button has-margin-right">New Post</a> --}}
        </div>
      </div>
    </div>

    <hr>

    <div class="page-content">

      <div class="columns">

        <div class="column">

          <div class="tabs">
            <ul>
              <li class="is-active"><a href="{{ action('CollectionController@showPost', ['collectionId' => $collection['id'], 'postId' => $currentPost['id']]) }}">General</a></li>
              <li><a href="{{ action('CollectionController@postContent', ['collectionId' => $collection['id'], 'postId' => $currentPost['id']]) }}">Content</a></li>
            </ul>
          </div>

          <form class="has-padding" style="background: white;" action="{{ action('PostController@update', $currentPost['id']) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <h3 class="title">General</h3>

            <hr>

            <div class="field is-horizontal">
              <div class="field-label">
                <label for="name">Name</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" name="name" value="{{ $currentPost['name'] }}" class="input">
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

@endsection
