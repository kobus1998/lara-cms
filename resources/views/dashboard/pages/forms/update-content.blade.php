<div class="content-tab toggle-tab">

  <div class="level">
    <div class="level-left">

    </div>
    <div class="level-right">
      {{-- <a class="button" data-modal="add-content-modal">Add Content to this page</a> --}}
      <a href="{{ action('ContentController@create') }}" class="button">New Content</a>
    </div>
  </div>

  <div class="field is-horizontal has-margin-top">
    <div class="field-label">
      <label></label>
    </div>
    <div class="field-body">
      <button type="submit" class="button is-primary update">Update</button>
    </div>
  </div>

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
