<!--
@param Array $model = model that you paginate
@param Array $queries = extra query strings
@param String $controller = controller of model
@param String $method = method of controller
-->

@php

  if (!isset($queries)) {
    $queries = [];
  }

  // $model = $model;
  $currentPage = app('request')->input('page');
  // $query = $query;
  if (empty($currentPage)) {
    $currentPage = 1;
  }

  $totalItems =  $model->total();
  $itemsPerPage = $model->perPage();;

  $totalPages = ceil($totalItems / $itemsPerPage);

  $previousPageQuery = array_merge($queries, ['page' => $currentPage - 1]);
  $nextPageQuery = array_merge($queries, ['page' => $currentPage + 1]);

@endphp

<div>
  <hr>
  <nav class="pagination" role="navigation" aria-label="pagination">
    <a class="pagination-previous"  href="{{ action($controller.'@'.$method, $previousPageQuery) }}" @if ($currentPage <= 1) disabled @endif>Previous</a>
    <a class="pagination-next"  href="{{ action($controller.'@'.$method, $nextPageQuery) }}" @if ($model->hasMorePages() == 0) disabled @endif>Next</a>
    <ul class="pagination-list">
      @for ($i = 1; $i <= $totalPages; $i++)
        <li>
          <a class="pagination-link
            @if ($currentPage == $i) is-current @endif"
            aria-label="Goto page {{ $i }}"
            href="{{ action($controller.'@'.$method, array_merge($queries, ['page' => $i])) }}">
            {{ $i }}
          </a>
        </li>
      @endfor
    </ul>
  </nav>
  <hr>
</div>
