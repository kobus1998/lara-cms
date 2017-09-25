@extends('layouts.app')

@section('content')

  <div class="has-margin-bottom">
    <div class="tabs">
      <ul>
        <li><a href="{{ action('CollectionController@showPost', ['collectionId' => $collection['id'], 'postId' => $currentPost['id']]) }}">General</a></li>
        <li class="is-active"><a href="{{ action('CollectionController@postContent', ['collectionId' => $collection['id'], 'postId' => $currentPost['id']]) }}">Content</a></li>
      </ul>
    </div>
  </div>

  <div class="page-content">

    <div class="columns">

      <div class="column">



        <form class="has-padding" style="background: white;" action="{{ action('PostController@updateContent', $currentPost['id']) }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT">

          <h3 class="title">Update</h3>

          <hr>

          @foreach ($currentPost['content'] as $content)
            <input type="hidden" name="content-id[]" value="{{ $content->id }}">
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
                      <input class="input" type="text" name="content[]" value="{{ $content->content }}">
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


@endsection
