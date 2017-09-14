<!--
@param Integer $model = The model you fetched
@param String $searchQuery = The search query
@param Array $extraQueries = Extra query strings
-->

@if (count($model) > 0 || app('request')->input('s') != null)
  <div class="level-right">
    @if (strlen($searchQuery) > 0)
      <form method="get">
        @foreach ($extraQueries as $key => $value)
          <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button type="submit" class="button is-link has-margin-right">clear</button>
      </form>
    @endif

    <form action="" method="get">
      <div class="field has-addons has-margin-right">
        <div class="control">
          @foreach ($extraQueries as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
          @endforeach
          <input placeholder="search" class="input" type="search" name="s" value="{{ $searchQuery }}">
        </div>
        <div class="control">
          <button type="submit" class="button is-primary"><span class="icon"><i class="fa fa-search"></i></span></button>
        </div>
      </div>
    </form>
    {{ $slot }}
  </div>
@endif
