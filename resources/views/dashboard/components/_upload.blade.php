<div class="media-upload">
  <form class="media-form" action="{{ action('MediaController@store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="field is-grouped" style="margin-bottom: 0">
      <label for="media" class="label has-pointer" aria-label="Click to select files">Select File(s) <span class="icon"><i class="fa fa-upload"></i></span></label>
      <div class="control">
        <input class="is-hidden" type="file" id="media" name="media[]" multiple/>
      </div>
      <div class="control">
        <button type="submit" class="button is-primary is-small">Upload</button>
      </div>
    </div>
    <ul class="files-info help"></ul>
  </form>
</div>
