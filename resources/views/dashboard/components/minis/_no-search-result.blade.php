<!--
@param Array $model = Fetched Model
-->

@if (count($model) == 0 && app('request')->input('s') != null)
  <div class="notification">
    <div class="content">
      <h4 class="title is-4">
        No search results
      </h4>
    </div>
  </div>
@endif
