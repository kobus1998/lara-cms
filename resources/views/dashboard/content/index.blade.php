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
        <a href="{{ action('ContentController@create') }}" class="button has-margin-right">New content</a>
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
          <h4 class="title is-4">Content</h4>
          @foreach ($content as $contentItem)
            <div class="draggable content-item is-clearfix is-new">
              <input type="hidden" name="content-id" value="{{ $contentItem->id }}">
              <input type="hidden" name="type" value="content">
              <input type="hidden" name="order" value="">
              <input type="hidden" name="page-content-id" value="">
              <div class="level">

                <div class="level-left">
                  {{ $contentItem->name }}
                </div>

                <div class="level-right">
                  <a class="tooltip left">
                    <input class="checkbox" type="checkbox" name="repeating" value="1">
                    <span class="tooltip-content">repeating group</span>
                  </a>
                  <a class="has-margin-left delete delete-content"></a>
                </div>

              </div>
            </div>
          @endforeach
          <hr>
          <h4 class="title is-4">Groups</h4>
          @foreach ($groups as $group)
            <div class="draggable content-item is-clearfix is-new">
              <input type="hidden" name="content-id" value="{{ $group->id }}">
              <input type="hidden" name="type" value="group">
              <input type="hidden" name="order" value="">
              <input type="hidden" name="page-content-id" value="">
              <div class="level">

                <div class="level-left">
                  {{ $group->name }}
                </div>

                <div class="level-right">
                  <a class="tooltip left">
                    <input class="checkbox" type="checkbox" name="repeating" value="1">
                    <span class="tooltip-content">repeating group</span>
                  </a>
                  <a class="has-margin-left delete delete-content"></a>
                </div>

              </div>
            </div>
          @endforeach
        </div>

      </div>
        @component('dashboard/components/_content-dashboard', [
          'viewContents' => $viewContents,
          'view' => app('request')->input('view') ])
          <button class="save-content-manager button is-primary has-margin-top is-pulled-right fixed-bottom is-right">save</button>
        @endcomponent
    @endif
@endsection
