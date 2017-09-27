<form id="create-page-form" class="is-white has-padding" action="{{ action('PageController@store') }}" method="post">
  <h1 class="title is-4">Create Page</h1>
  <hr>
  {{ csrf_field() }}

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="name">Name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input id="name" type="text" name="name" class="input" value="">
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
          <textarea name="desc" class="textarea" rows="8" cols="80"></textarea>
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
          <input id="url" type="text" class="input" name="url" value="">
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label></label>
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
