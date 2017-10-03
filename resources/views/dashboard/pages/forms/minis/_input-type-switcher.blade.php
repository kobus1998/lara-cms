<!--
@param $classes = additional classes
@param $value = value of input
@param $name = name of input
@param $type = type of input
-->

@if ($type == 'textfield')
  <input class="input grow {{ $classes }}" type="text" name="{{ $name }}" value="{{ $value }}">
@elseif ($type == 'textarea')
  <textarea class="textarea grow {{ $classes }}" name="{{ $name }}" rows="8" cols="80">{{ $value }}</textarea>
@elseif ($type == 'media')
  @isset($src)
    <img class="media-img image is-128x128" src="{{ $src }}" alt="">
  @endisset
  <input class="img-manager-target {{ $classes }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
@elseif ($type == 'checkbox')
  <input class="checkbox grow {{ $classes }}" type="checkbox" name="{{ $name }}" value="{{ $value }}">
@endif
