<form id="update-media-form" action="{{ action('MediaController@update', $media->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">

  <div class="field">
    <label for="">Name</label>
    <div class="control">
      <input type="text" name="name" value="{{ $media->name }}" class="input">
    </div>
  </div>

  <div class="field">
    <label for="">Desctiption</label>
    <div class="control">
      <textarea class="textarea" name="desc" rows="8" cols="80">{{ $media->desc }}</textarea>
    </div>
  </div>

  <div class="field">
    <label for="">Alt</label>
    <div class="control">
      <input type="text" name="alt" value="{{ $media->alt }}" class="input">
    </div>
  </div>

  <button type="submit" class="button is-primary">Update</button>

</form>
