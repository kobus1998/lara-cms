<!--
@param Model medias = all images
@param String root = root class
@param String target = target class
-->


<div class="img-manager is-white has-padding" data-toggled-btn="">
  <h3 class="title is-3">Media manager</h3>
  <hr>
  <div class="columns is-multiline">
    @foreach ($medias as $media)
      <div class="column is-3 is-clipped img-manager-item" data-img-id="{{ $media->original }}">
        <img class="image is-128x128" src="{{ $media->getImg($media->path, 'small') }}" alt="">
      </div>
    @endforeach
  </div>

</div>
