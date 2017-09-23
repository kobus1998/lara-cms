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
          <a href="{{ action('PageController@create') }}" class="button has-margin-right">New Post</a>
        </div>
      </div>
    </div>

    <hr>

    <div class="page-content">

      <div class="columns">

        <div class="column is-3">
          @component('dashboard/collections/components/post-list', ['posts' => $posts, 'collection' => $collection, 'activeId' => $currentPost['id']])

          @endcomponent
        </div>

        <div class="column">
          <form class="has-padding" style="background: white;" action="index.html" method="post">

            <h3 class="title">Update</h3>

            <hr>

            @foreach ($currentPost['content'] as $content)
              @php
                $type = $content->type->type['name'];
              @endphp
              <div class="field is-horizontal">
                <div class="field-label">
                  <label for="">{{ $content->type->name }}</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      @if ($type == 'textfield')
                        <input class="input" type="text" name="content[]" value="{{ $content->content }}">
                      @elseif ($type == 'textarea')
                        <textarea class="textarea" name="content[]" rows="8" cols="80">{{ $content->content }}</textarea>
                      @elseif ($type == 'media')
                        <img src="https://placehold.it/250x250" alt="">
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

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
