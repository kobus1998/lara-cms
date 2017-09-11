<form action="{{ action('PageController@addContent', $page->id) }}" class="modal add-content-modal" method="post">
  {{ $page->id }}
  <div class="modal-background" data-modal="add-content-modal"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>
      <a class="delete hide-modal" data-modal="add-content-modal"></a>
    </header>
    <section class="modal-card-body">
        {{ csrf_field() }}
        <ul>
          @foreach ($contents as $content)
            <li><input {{ in_array($content->id, $page->contentIds) ? 'checked' : '' }} type="checkbox" name="id[]" value="{{ $content->id }}" class="has-margin-right"> {{ $content->name }}</li>
          @endforeach
        </ul>
    </section>
    <footer class="modal-card-foot">
      <button type="submit" class="button is-success">Save changes</button>
      <a class="button" data-modal="add-content-modal">Cancel</a>
    </footer>
  </div>
</form>
