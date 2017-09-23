@extends('layouts.app')

@section('content')

  <div class="page-content">

    <div class="level no-margin">
      <div class="level-left">
        <div class="level-item">
          @component('dashboard/components/_bread-crumb', ['navs' => [
              [
                'name' => 'Collections',
                'action' => action('CollectionController@index'),
                'active' => false,
              ], [
                'name' => $collection['name'],
                'action' => action('CollectionController@show', $collection['id']),
                'active' => true,
              ]
            ]])
          @endcomponent
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <a class="button has-margin-right toggle-modal-create-post">New Post</a>
        </div>
      </div>
    </div>

    <hr>

    <div class="page-content">

      <div class="columns">

        <div class="column is-3">
          @component('dashboard/collections/components/post-list', ['posts' => $posts, 'collection' => $collection])

          @endcomponent
        </div>

        <div class="column">

          <div class="tabs">
            <ul>
              <li><a href="{{ action('CollectionController@show', $collection['id']) }}">General</a></li>
              <li class="is-active"><a href="{{ action('CollectionController@edit', $collection['id']) }}">Manage fields</a></li>
            </ul>
          </div>

          <form id="update-order-form" class="has-padding" action="{{ action('CollectionController@updateOrder', $collection['id']) }}" method="post" style="background: white;">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="collection-id" value="{{ $collection['id'] }}">
            {{ csrf_field() }}

            <h3 class="title">Manage Fields <a class="button is-primary is-pulled-right is-small toggle-modal-add-collection-content"><span class="icon is-small"><i class="fa fa-plus"></i></span></a></h3>

            <hr>

            <div class="sortable-field" style="position: relative">

              @foreach ($collection->contents as $content)
                @php
                  $type = $content->type['name'];
                @endphp

                <div class="box draggable-field has-pointer">
                  <input type="hidden" name="order[]" value="{{ $content->order }}">
                  <input type="hidden" name="name" value="{{ $content->name }}">
                  <input type="hidden" name="id[]" value="{{ $content->id }}">
                  <input type="hidden" name="collection-id" value="{{ $collection->id }}">
                  <p>
                    {{ $content->name }} |
                    {{ $content->type->name }}
                    <a class="delete-content-field button is-danger is-pulled-right is-small"><span class="icon is-small"><i class="fa fa-times"></i></span></a>
                  </p>
                </div>

              @endforeach
            </div>

            <button type="submit" class="button is-primary">Update</button>

          </form>
        </div>

      </div>


    </div>

  </div>

  @component('dashboard/components/minis/_modal', [
    'switchClass' => 'toggle-add-collection-content',
    'position' => 'is-top'])
    @component('dashboard/collections/forms/add-collection-field', ['collection' => $collection, 'types' => $types])@endcomponent
  @endcomponent

  @component('dashboard/components/minis/_modal', [
    'switchClass' => 'toggle-create-post',
    'position' => 'is-top'
  ])
    @component('dashboard/collections/forms/create-post', ['collection' => $collection])@endcomponent
  @endcomponent

@endsection
