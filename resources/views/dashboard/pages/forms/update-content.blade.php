<div class="content-tab toggle-tab">

  <div class="level">
    <div class="level-left">

    </div>
    <div class="level-right">
      <a class="button">Add Content to this page</a>
      <a href="{{ action('ContentController@create') }}" class="button">New Content</a>
    </div>
  </div>

  @if (count($page->content) == 0)

    <div class="notification">
      <div class="content">
        <h4 class="title is-4">
          This page has no content yet.
          {{-- <a class="button is-primary is-pulled-right" href="{{ action('PageController@create') }}">Create a page</a> --}}
        </h4>
      </div>
    </div>

  @else
    <form action="{{ action('ContentController@updateMultiple') }}" method="post">

      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      @foreach ($page->content as $content)

        <input type="hidden" name="id[]" value="{{ $content->id }}">
        <input type="hidden" name="name[]" value="{{ $content->name }}">
        <input type="hidden" name="title[]" value="{{ $content->title }}">

        <div class="field is-horizontal">
          <div class="field-label">
            <label for="content">{{ $content->name }}</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                @if ($content->type->name == 'textfield')
                  <input class="input" type="text" name="content[]" value="{{ $content->body }}">
                @elseif ($content->type->name == 'textarea')
                  <textarea class="textarea" name="content[]" rows="8" cols="80">{{ $content->body }}</textarea>
                @elseif ($content->type->name == 'media')
                  <input type="file" name="content[]" value="{{ $content->body }}">
                @elseif ($content->type->name == 'checkbox')
                  <input class="checkbox" type="checkbox" name="content[]" value="{{ $content->body }}">
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    <div class="field is-horizontal">
      <div class="field-label">
        <label></label>
      </div>
      <div class="field-body">
        <button type="submit" class="button is-primary">Update</button>
      </div>
    </div>

  </form>
  @endif

</div>
