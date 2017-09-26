<form id="update-page-seo-form" class="has-padding is-white" action="{{ action('PageController@updateSeo', $page->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="seo-title">Seo Title</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input type="text" name="seo-title" value="{{ $page->seo_title }}" class="input">
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="seo-keywords">Keywords</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input type="text" name="seo-keywords" value="{{ $page->seo_keywords }}" class="input" placeholder="Seperate with commas">
        </div>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="seo-desc">Seo Description</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <textarea name="seo-desc" rows="8" cols="80" class="textarea">{{ $page->seo_desc }}</textarea>
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
          <button type="submit" class="button is-primary">Update</button>
        </div>
      </div>
    </div>
  </div>

</form>
