<div class="content-tab toggle-tab">

  <div class="level">
    <div class="level-left">

    </div>
    <div class="level-right">
      {{-- <a class="button" data-modal="add-content-modal">Add Content to this page</a> --}}
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
    <input type="hidden" name="page-id" value="{{ $page->id }}">

    @foreach ($pageContents as $pageContent)
      <div class="page-content">
        @if ($pageContent['group'] == true)
          <hr>
        @endif
        @if ($pageContent['group'] == true)

          @foreach ($pageContent['content'] as $content)
            <div class="field is-horizontal">
              <div class="field-label">
                <label for="content">{{ $content->name }}</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control has-margin-bottom">
                    @component('dashboard/pages/forms/minis/_input-type-switcher', [
                      'name' => 'content',
                      'value' => $content->pivot->body,
                      'type' => $content->type->name,
                      'classes' => ''
                    ]) @endcomponent
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        @else
        <div class="field is-horizontal">
          <div class="field-label">
            <label for="content">{{ $pageContent->name }}</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control has-margin-bottom">
                @component('dashboard/pages/forms/minis/_input-type-switcher', [
                  'name' => 'content',
                  'value' => $pageContent->pivot->body,
                  'type' => $pageContent->type->name,
                  'classes' => ''
                ]) @endcomponent
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
    @endforeach

    {{-- @foreach ($page->content as $content)
      <div class="page-content">
        <input type="hidden" name="content-id" value="{{ $content->pivot->id }}">
        <input type="hidden" name="name" value="{{ $content->name }}">
        <input type="hidden" name="repeating" value="{{ $content->pivot->repeating }}">

        <div class="field is-horizontal">
          <div class="field-label">
            <label for="content">{{ $content->name }}</label>
          </div>
          <div class="field-body">
            <div class="field">
              @if ($content->pivot->repeating == 1)
                <span class="copy-field">
                  <div class="control has-margin-bottom is-new">
                    <div class="align-center">
                      @component('dashboard/pages/forms/minis/_input-type-switcher', [
                        'name' => 'content',
                        'value' => $content->pivot->body,
                        'type' => $content->type->name,
                        'classes' => ''
                      ]) @endcomponent
                      <a class=" has-margin-left button is-danger"><span class="icon is-small"><i class="fa fa-times"></i></span></a>
                    </div>
                  </div>
                </span>

                @foreach ($content->repeatingContent as $repeatingContent)
                  <div class="control has-margin-bottom">
                    <div class="align-center">
                      @component('dashboard/pages/forms/minis/_input-type-switcher', [
                        'name' => 'content',
                        'value' => $content->pivot->body,
                        'type' => $content->type->name,
                        'classes' => ''
                      ]) @endcomponent
                      <a class=" has-margin-left button is-danger"><span class="icon is-small"><i class="fa fa-times"></i></span></a>
                    </div>
                  </div>
                @endforeach

                <div class="control has-button">
                  <a class="button add-repeating-group"><span>Add row</span><span class="icon is-small"><i class="fa fa-plus"></i></span></a>
                </div>
              @else
                <div class="control has-margin-bottom">
                  @if ($content->type->name == 'textfield')
                    <input class="input" type="text" name="content" value="{{ $content->pivot->body }}">
                  @elseif ($content->type->name == 'textarea')
                    <textarea class="textarea" name="content" rows="8" cols="80">{{ $content->pivot->body }}</textarea>
                  @elseif ($content->type->name == 'media')
                    <input class="file" type="file" name="content" value="{{ $content->pivot->body }}">
                  @elseif ($content->type->name == 'checkbox')
                    <input class="checkbox" type="checkbox" name="content" value="{{ $content->pivot->body }}">
                  @endif
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach --}}
  <div class="field is-horizontal has-margin-top">
    <div class="field-label">
      <label></label>
    </div>
    <div class="field-body">
      <button type="submit" class="button is-primary update">Update</button>
    </div>
  </div>
  @endif

  <script>
    $(document).on('click', '.add-repeating-group', function () {
      var field = $(this).closest('.field')
      var input = field.find('.copy-field').find('.control')
      var clone = input.clone()
      clone.insertBefore($(this))
    })

    $(document).on('click', '.update', function () {
      var contentTab = $(this).closest('.content-tab')
      var pageContent = contentTab.find('.page-content')
      var pageId = contentTab.find('input[name="page-id"]').val()
      var page = {
        id: pageId,
        content: []
      }
      pageContent.each(function () {
        var repeating = $(this).find('input[name="repeating"]').val()

        var content = {
          id: $(this).find('input[name="content-id"]').val(),
          name: $(this).find('input[name="name"]').val(),
          repeating: repeating,
        }

        var repeatInt = parseInt(repeating)

        if (repeatInt === 1) {

          content.body = []

          $(this).find('input[name="content"]').each(function (index) {
            var isNew = false

            if ($(this).closest('.control').hasClass('is-new')) isNew = true

            if (index !== 0) {
              content.body.push({
                content: $(this).val(),
                isNew: isNew
              })
            }
          })

        } else {
          content.body = $(this).find('input[name="content"]').val()
        }

        page.content.push(content)

      })

      window.axios.post('/api/cms/page-methods/save-content-body/' + pageId, page).then(function (response) {
        console.log(response)
      }).catch(function (err) {
        console.log(err)
      })


    })
  </script>

</div>
