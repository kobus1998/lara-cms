<form id="update-page-form" class="has-padding is-white" action="{{ action('PageController@updateSeo', $page->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">

  <h3 class="title">General</h3>

  <hr>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="name">Name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input class="input" type="text" name="name" value="{{ $page['name'] }}" required>
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="url">Url</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input class="input" type="text" name="url" value="{{ $page['url'] }}" required>
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="desc">Description</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <textarea class="textarea" name="desc" rows="8" cols="80">{{ $page['desc'] }}</textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label></label>
    </div>
    <div class="field-body">
      <p class="control">
        <button type="submit" class="button is-primary">Update</button>
      </p>
    </div>
  </div>

</form>
