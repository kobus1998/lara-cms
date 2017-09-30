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



        <form id="update-post-content-form" class="has-padding" style="background: white;" action="{{ action('PostController@updateContent', $currentPost['id']) }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT">

          <h3 class="title">Update</h3>

          <hr>

          @foreach ($currentPost['content'] as $content)
            <input type="hidden" name="items[{{ $content->id }}][id]" value="{{ $content->id }}">
            @php
              $type = $content->type->type['name'];
            @endphp
            @if ($content->repeatable == 1)
              <div class="repeatable-wrapper">
                <input type="hidden" name="items[{{ $content->id }}][is-repeatable]" value="1">
                <div class="field is-horizontal">
                  <div class="field-label">
                    <label for="">{{ $content->type->name }}</label>
                  </div>
                  <div class="field-body"><a data-action="{{action('PostController@addRepeatingContent', $content->id)}}" class="button is-primary is-small add-repeating-content"><span class="icon is-small"><i class="fa fa-plus"></i></span></a></div>
                </div>
                <div class="sortable">
                  @foreach ($content->repeatingContent as $repeatable)
                    <div class="draggable delete-root has-margin-bottom">
                      <input type="hidden" name="items[{{$content->id}}][repeatable][{{$repeatable->id}}][id]" value="{{$repeatable->id}}">
                      <input class="order" type="hidden" name="items[{{$content->id}}][repeatable][{{$repeatable->id}}][order]" value="{{$repeatable->order}}">
                      <div class="field is-horizontal">
                        <div class="field-label">
                          <span class="icon"><i class="fa fa-sort"></i></span>
                        </div>
                        <div class="field-body">
                          <div class="field has-addons">
                            <div class="control has-input">
                              @if ($type == 'textfield')
                                <input class="input" type="text" name="items[{{ $content->id }}][repeatable][{{$repeatable->id}}][content]" value="{{ $repeatable->content }}">
                              @elseif ($type == 'textarea')
                                <textarea class="textarea" name="items[{{ $content->id }}][repeatable][{{$repeatable->id}}][content]" rows="8" cols="80">{{ $repeatable->content }}</textarea>
                              @elseif ($type == 'media')
                                <input class="input" type="text" name="items[{{ $content->id }}][repeatable][{{$repeatable->id}}][content]" value="{{ $repeatable->content }}">
                              @endif
                            </div>
                            <div class="control">
                              <a data-action="{{ action('PostController@deleteRepeatingContent', $repeatable->id) }}" class=" xy-delete-content button is-danger"><span class="icon"><i class="fa fa-trash"></i></span></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @else
              <input type="hidden" name="items[{{ $content->id }}][is-repeatable]" value="0">
              <div class="field is-horizontal">
                <div class="field-label">
                  <label for="">{{ $content->type->name }}</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      @if ($type == 'textfield')
                        <input class="input" type="text" name="items[{{ $content->id }}][content]" value="{{ $content->content }}">
                      @elseif ($type == 'textarea')
                        <textarea class="textarea" name="items[{{ $content->id }}][content]" rows="8" cols="80">{{ $content->content }}</textarea>
                      @elseif ($type == 'media')
                        <input class="input" type="text" name="items[{{ $content->id }}][content]" value="{{ $content->content }}">
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endif
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
