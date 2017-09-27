<form id="update-page-content-form" action="{{ action('PageController@updateContent', $page->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">
  <div class="fields">
    @foreach ($page->content as $content)
      <input type="hidden" name="content[{{$content->id}}][id][]" value="{{ $content->id }}">
      <div class="field is-horizontal">
        <div class="field-label">
          <label for="content">{{ $content->name }}</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              @component('dashboard/pages/forms/minis/_input-type-switcher', [
                'classes' => '',
                'value' => $content->content,
                'name' => 'content['.$content->id.'][body][]',
                'type' => $content->type->name
              ])@endcomponent
            </div>
          </div>
        </div>
      </div>
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
