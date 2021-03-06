<form id="create-post-form" action="{{ action('PostController@store') }}" method="post" class="has-padding" style="background: white;">
  {{ csrf_field() }}

  <input type="hidden" name="collection-id" value="{{ $collection['id'] }}">

  <h3 class="title is-3">Create Post</h3>

  <hr>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="">Post name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input type="text" name="name" value="" class="input">
        </div>
      </div>
    </div>
  </div>

  <h3 class="title is-4">Content (optional)</h3>

  <hr>

  @foreach ($collection->contents as $content)
    <input type="hidden" name="content-id[]" value="{{ $content->id }}">
    <input type="hidden" name="order[]" value="{{ $content->order }}">
    <div class="field is-horizontal">
      <div class="field-label">
        <label>{{ $content->name }}</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            @component('dashboard/components/minis/_input-type-switcher', [
              'classes' => '',
              'value' => '',
              'name' => 'post-content[]',
              'type' => $content->type->name
              ])@endcomponent
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
          <button type="submit" class="button is-primary">Create</button>
        </div>
      </div>
    </div>
  </div>

</form>
