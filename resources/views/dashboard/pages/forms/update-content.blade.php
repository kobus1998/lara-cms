<form id="update-page-content-form" action="{{ action('PageController@updateContent', $page->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">
  <div class="fields">
    @foreach ($page->content as $content)
      <input type="hidden" name="items[{{ $content->id }}][id]" value="{{ $content->id }}">
      @if ($content->repeatable == 1)
        <div class="repeatable-wrapper">
          <input type="hidden" name="items[{{ $content->id }}][is-repeatable]" value="1">
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">{{ $content->name }}</label>
            </div>
            <div class="field-body"><a data-action="{{action('PageController@addRepeatingContent', $content->id)}}" class="button is-primary is-small add-repeating-content"><span class="icon is-small"><i class="fa fa-plus"></i></span></a></div>
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
                        @component('dashboard/pages/forms/minis/_input-type-switcher', [
                          'classes' => '',
                          'value' => $repeatable->content,
                          'name' => 'items['.$content->id.'][repeatable]['.$repeatable->id.'][content]',
                          'type' => $content->type->name
                          ])@endcomponent
                      </div>
                      <div class="control">
                        <a data-action="{{ action('PageController@deleteRepeatingContent', $repeatable->id) }}" class=" xy-delete-content button is-danger"><span class="icon"><i class="fa fa-trash"></i></span></a>
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
            <label for="">{{ $content->name }}</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                @component('dashboard/pages/forms/minis/_input-type-switcher', [
                  'classes' => '',
                  'value' => $content->content,
                  'name' => 'items['.$content->id.'][content]',
                  'type' => $content->type->name
                  ])@endcomponent
              </div>
            </div>
          </div>
        </div>
      @endif

    @endforeach
  </div>

  <div class="field is-horizontal has-margin-top has-margin-bottom">
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
