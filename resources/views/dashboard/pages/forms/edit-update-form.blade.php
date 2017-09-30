<form id="edit-update-page-content-form" action="{{ action('PageController@editContent', $page->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">

  <div class="sortable" style="position: relative">
    @foreach ($page->content as $content)
      <div class="box draggable has-pointer delete-root">
        <input type="hidden" class="order" name="items[{{ $content->id }}][order]" value="{{ $content->order }}">
        <input type="hidden" name="items[{{ $content->id }}][id]" value="{{ $content->id }}">
        <div class="field has-addons">
          <p class="control"><span class="icon is-medium"><i class="fa fa-sort"></i></span></p>
          <p class="control has-input has-margin-right has-margin-left">
            <input type="text" name="items[{{$content->id}}][name]" value="{{ $content->name }}" class="input">
          </p>
          <p class="control has-margin-left tooltip left">
            <span><input {{ ($content->repeatable == 1) ? 'checked' : '' }} type="checkbox" name="items[{{$content->id}}][repeatable]" value="{{ $content->repeatable }}"></span>
            <span class="tooltip-content">Repeating content.</span>
          </p>
          <p class="control ">
            <div class="select has-margin-left">
              <select name="items[{{$content->id}}][type]">
                @foreach ($types as $type)
                  <option {{ ($type->id === $content->type->id) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
              </select>
            </div>
          </p>
          <p class="control has-margin-left">
            <a data-action="{{ action('PageController@deleteContent', ['pageId' => $page->id, 'contentId' => $content->id]) }}" class="xy-delete-content button is-danger is-pulled-right"><span class="icon is-small"><i class="fa fa-times"></i></span></a>
          </p>
        </div>
      </div>
    @endforeach
  </div>

  <div class="field">
    <div class="control">
      <button type="submit" class="button is-primary">Update</button>
    </div>
  </div>

</form>
