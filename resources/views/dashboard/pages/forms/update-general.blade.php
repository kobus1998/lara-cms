<form action="{{ action('PageController@update', $page->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">

  <input type="hidden" name="req-type" value="general">

  <div class="general-tab toggle-tab is-active">

    <div class="field is-horizontal">
      <div class="field-label">
        <label for="name">Name</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input class="input" type="text" name="name" value="{{ $page['name'] }}" required>
          </div>
          @if ($errors->has('name'))
            <p class="help is-danger">{{ $errors->first('name') }}</p>
          @endif
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
          @if ($errors->has('url'))
            <p class="help is-danger">{{ $errors->first('url') }}</p>
          @endif
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label">
        <label for="type">Type</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <span class="select">
              <select name="type" required>
                <option value=""></option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" {{ ($type->id === $page->type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
              </select>
            </span>
            @if ($errors->has('type'))
              <p class="help is-danger">{{ $errors->first('type') }}</p>
            @endif
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
          @if ($errors->has('desc'))
            <p class="help is-danger">{{ $errors->first('desc') }}</p>
          @endif
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

  </div>
</form>
