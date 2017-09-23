<div class="post-list-wrapper">
  <h3 class="post-list-item title">Posts</h3>
  <hr>
  <ul class="post-list">
    @foreach ($posts as $post)
      <li><a href="{{ action('CollectionController@showPost', [$collection['id'],$post['id']]) }}" class="
        post-list-item @isset ($activeId) @if ($activeId == $post['id']) is-active color-white @endif @endisset
        ">{{ $post['name'] }}</a></li>
    @endforeach
  </ul>
</div>
