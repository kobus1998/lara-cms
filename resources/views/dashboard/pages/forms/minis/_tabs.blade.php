<!--
@param Object $page = page object
@param String $isActive = element to be active
-->

<div class="has-margin-bottom is-white">
  <div class="tabs">
    <ul>
      <li class="{{ ($isActive === 'general') ? 'is-active' : '' }}"><a href="{{ action('PageController@show', $page->id) }}">General</a></li>
      <li class="{{ ($isActive === 'content') ? 'is-active' : '' }}"><a href="{{ action('PageController@showContent', $page->id) }}">Content</a></li>
      <li class="{{ ($isActive === 'seo') ? 'is-active' : '' }}"><a href="{{ action('PageController@showSeo', $page->id) }}">SEO</a></li>
      <li class="{{ ($isActive === 'settings') ? 'is-active' : '' }}"><a href="{{ action('PageController@showSettings', $page->id) }}"><span class="icon"><i class="fa fa-cog"></i></span></a></li>
      <li><a target="_blank" href="{{ action('PageController@route', $page['url']) }}" class="button is-link">Visit</a></li>
    </ul>
    <ul class="is-right">
      {{ $slot }}
    </ul>
  </div>
</div>
