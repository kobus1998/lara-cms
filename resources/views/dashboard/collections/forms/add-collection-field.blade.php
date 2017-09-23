<form id="add-content-field-form" class="has-padding is-white" action="{{ action('CollectionController@addContent', $collection['id']) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="collection-id" value="{{ $collection['id'] }}">


  <h3 class="is-title is-3">Add Content Field</h3>
  <hr>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="name">Name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input type="text" name="name" class="input">
        </div>
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
          <div class="select" style="width: 100%;">
            <select name="type-id" style="width: 100%;">
              <option></option style="width: 100%;">
              @foreach ($types as $type)
                <option style="width: 100%;" value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
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
          <button type="submit" class="button is-primary">Add</button>
        </div>
      </div>
    </div>
  </div>


</form>
