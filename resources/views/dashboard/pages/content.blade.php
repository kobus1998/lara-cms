@extends('layouts.app')

@section('content')

  @component('dashboard/pages/forms/minis/_tabs', ['page' => $page, 'isActive' => 'content'])@endcomponent

  <div class="page-content has-padding is-white">
    <h3 class="title">Content</h3>
    <hr>

    @component('dashboard/components/minis/_no-results', ['items' => $page->content, 'name' => 'content'])
      @include('dashboard/pages/forms/update-content')
    @endcomponent
  </div>



@endsection
