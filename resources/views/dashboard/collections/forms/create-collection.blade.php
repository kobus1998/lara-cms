<form id="create-collection-form" action="{{ action('CollectionController@store') }}" method="post" class="has-padding" style="background: white;">
  {{ csrf_field() }}

  <h3 class="title is-3">Create Collection</h3>

  <hr>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="">Name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input type="text" name="name" value="" class="input">
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
          <textarea name="desc" rows="8" cols="80" class="textarea"></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="all">all pages</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input type="checkbox" name="all" value="" class="checkbox">
        </div>
      </div>
    </div>
  </div>

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
