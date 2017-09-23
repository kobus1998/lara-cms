@php
  if (!isset($position)) {
    $position = '';
  }
@endphp

<div class="modal has-margin-sidebar has-margin-header {{ $position }} {{ $switchClass }}">
  <div class="modal-background has-pointer"></div>
  <div class="modal-content width-auto">
    {{ $slot }}
  </div>
</div>
