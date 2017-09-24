<!--
@param Array $items = items to check
@param String $name = name to check
-->

@if (count($items) == 0)
  @php
    $searchQuery = app('request')->input('s');
  @endphp
  <div class="notification is-info no-result">
    <div class="content">
      @if (count($searchQuery) > 0 || $searchQuery !== null)
        No search results
      @else
        You don't have any {{ $name }} yet
      @endif
    </div>
  </div>
@else
  {{ $slot }}
@endif
