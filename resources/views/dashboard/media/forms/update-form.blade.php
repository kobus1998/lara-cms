<form class="" action="index.html" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">

  <div class="field">
    <label for="">Title</label>
    <div class="control">
      <input type="" name="" value="" class="input">
    </div>
  </div>

  <div class="field">
    <label for="">Desctiption</label>
    <div class="control">
      <textarea class="textarea" name="name" rows="8" cols="80"></textarea>
    </div>
  </div>

  <div class="field">
    <label for="">Alt</label>
    <div class="control">
      <input type="" name="" value="" class="input">
    </div>
  </div>

  <button type="submit" class="button is-primary">Update</button>

</form>
