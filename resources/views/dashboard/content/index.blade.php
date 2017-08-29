@extends('layouts.app')

@section('content')

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        <h4 class="title is-4 has-text-left">Content</h4>
      </div>
    </div>
    <div class="level-right">
      <div class="level-item">
        {{-- <a href="{{ action('ContentController@createGroup') }}" class="button has-margin-right">New group</a> --}}
        <a href="{{ action('ContentController@create') }}" class="button has-margin-right">New content</a>
        {{-- <form class="" action="index.html" method="post">
          <div class="field has-addons">
            <p class="control">
              <input type="text" name="search" value="{{ old('search') }}" class="input search" placeholder="Search page">
            </p>
            <p class="control">
              <button type="submit" class="button"><span class="icon is-small"><i class="fa fa-search"></i></span></button>
            </p>
          </div>
        </form> --}}
      </div>
    </div>
  </div>

  <hr>

  @if (count($content) == 0)

    <div class="notification">
      <div class="content">
        <h4 class="title is-4">
          You don't have any content yet
          <a class="button is-primary is-pulled-right" href="{{ action('ContentController@create') }}">Create content</a>
        </h4>
      </div>
    </div>

  @else

    <div class="content-manager">

      <div class="content-sidebar">

        <div class="content-list">
          @foreach ($content as $contentItem)
            <div class="draggable content-item is-clearfix is-new">
              <input type="hidden" name="content-id" value="{{ $contentItem->id }}">
              <input type="hidden" name="order" value="">
              <p>
                <span class="is-pulled-left">
                  {{ $contentItem->name }}
                </span>
                <small class="is-pulled-right delete"></small>
              </p>
            </div>
          @endforeach
        </div>

      </div>

      <div class="pages-manager">
        @foreach ($pages as $page)
          <div class="page update-order">
            <input type="hidden" name="page-name" value="{{ $page->name }}">
            <h4 class="title is-4"><a href="{{ action('PageController@show', $page->id) }}">{{ $page->name }}</a></h4>
            <hr>
            <div class="droppable sortable">
              <input type="hidden" name="_method" value="put">
              <input type="hidden" name="page-id" value="{{ $page->id }}">
              {{ csrf_field() }}

              @foreach ($page->content as $contentItem)
                <div class="content-item is-clearfix">
                  <input type="hidden" name="content-id" value="{{ $contentItem->id }}">
                  <input type="hidden" name="order" value="{{ $contentItem->pivot->order }}">
                  <p>
                    <span class="is-pulled-left">
                      {{ $contentItem->name }}
                    </span>
                    <small class="is-pulled-right">
                      <button type="submit" class="delete delete-content"></button>
                    </small>
                  </p>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
        <button class="save-content-manager button is-primary has-margin-top is-pulled-right fixed-bottom is-right">save</button>
      </div>
    @endif
@endsection
