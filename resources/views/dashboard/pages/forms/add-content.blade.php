<form action="{{ action('PageController@addContent', $page->id) }}" class="modal is-active" method="post">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>
      <button class="delete hide-modal"></button>
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
      <a class="button hide-modal">Cancel</a>
    </footer>
  </div>
</form>
