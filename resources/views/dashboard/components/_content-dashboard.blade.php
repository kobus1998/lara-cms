@php
  $saveUrl = '/api/cms/page-methods/save-content-manager';
  $deleteUrl = '/api/cms/page-methods/delete-content';
  $showAction = 'PageController@show';
@endphp

@if ($view == 'modules')
  @php
    $saveUrl = '/api/cms/module-methods/save-content-manager';
    $deleteUrl = '/api/cms/module-methods/delete-content';
    $showAction = 'ModuleController@show';
  @endphp
@endif
<div class="pages-manager">
  <input type="hidden" name="save-url" value="{{ $saveUrl }}">
  <input type="hidden" name="delete-url" value="{{ $deleteUrl }}">
  @foreach ($viewContents as $viewContent)
    <div class="page update-order">
      <input type="hidden" name="page-id" value="{{ $viewContent->id }}">
      {{-- <input type="hidden" name="page-id" value="{{ $viewContent->name }}"> --}}
      <h4 class="title is-4"><a href="{{ action($showAction, $viewContent->id) }}">{{ $viewContent->name }}</a></h4>
      <hr>
      <div class="droppable sortable">
        @foreach ($viewContent->content as $contentItem)
          <div class="content-item is-clearfix">
            <input type="hidden" name="content-id" value="{{ $contentItem->id }}">
            <input type="hidden" name="page-content-id" value="{{ $contentItem->pivot->id }}">
            <input type="hidden" name="order" value="{{ $contentItem->pivot->order }}">
            <div class="level">

              <div class="level-left">
                {{ $contentItem->name }}
              </div>

              <div class="level-right">
                <a class="tooltip left">
                  <input class="checkbox" type="checkbox" name="repeating" value="1" @if ($contentItem->pivot->repeating == 1) checked @endif>
                  <span class="tooltip-content">repeating group</span>
                </a>
                <a class="has-margin-left delete delete-content"></a>
              </div>

            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
  {{ $slot }}
</div>
