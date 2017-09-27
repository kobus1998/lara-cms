@extends('layouts.app')

@section('content')

  @component('dashboard/pages/forms/minis/_tabs', ['page' => $page, 'isActive' => 'content'])@endcomponent

  <div class="page-content has-padding is-white">
    <h3 class="title">Content
      <a class="is-pulled-right button is-primary is-small toggle-modal-update-page-content">
        <span class="icon is-small"><i class="fa fa-plus"></i></span>
      </a>
      <a class="is-pulled-right button is-primary is-small has-margin-right toggle-edit-field">
        <span class="icon is-small"><i class="fa fa-pencil"></i></span>
      </a>
    </h3>
    <hr>

    @component('dashboard/components/minis/_no-results', ['items' => $page->content, 'name' => 'content'])
      @include('dashboard/pages/forms/update-content')
      @include('dashboard/pages/forms/edit-update-form')
    @endcomponent

    @component('dashboard/components/minis/_modal', ['position' => 'is-top', 'switchClass' => 'toggle-update-page-content'])
      @include('dashboard/pages/forms/add-content')
    @endcomponent
  </div>



@endsection
