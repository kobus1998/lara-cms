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
                'active' => false,
              ], [
                'name' => 'Posts',
                'action' => app('request')->url(),
                'active' => true
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

        <div class="column">

          <div class="tabs">
            <ul>
              <li><a href="{{ action('CollectionController@show', $collection['id']) }}">General</a></li>
              <li class="is-active"><a href="{{ action('CollectionController@collectionPosts', $collection['id']) }}">Posts</a></li>
              <li><a href="{{ action('CollectionController@edit', $collection['id']) }}">Manage fields</a></li>
            </ul>
          </div>

          <form id="delete-multiple-posts-form" action="{{ action('PostController@deleteMultiple') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="collection-id" value="{{ $collection['id'] }}">

            <table class="table table-striped">
              <thead>
                <th><input class="all-checkboxes" type="checkbox"></th>
                <th>Name</th>
                <th>Created at</th>
                <th><button type="submit" class="is-danger button is-small"><span class="icon is-small"><i class="fa fa-trash"></i></span></button></th>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                  <tr>
                    <td><input class="form-checkboxes" type="checkbox" name="ids[]" value="{{ $post['id'] }}"></td>
                    <td><a href="{{ action('CollectionController@showPost',['collectionId' => $collection['id'], 'postId' => $post['id']]) }}">{{ $post['name'] }}</a></td>
                    <td>{{ $post['created_at'] }}</td>
                    <td></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </form>


        </div>

      </div>


    </div>

    @component('dashboard/components/minis/_modal', [
      'switchClass' => 'toggle-create-post',
      'position' => 'is-top'
    ])
    @component('dashboard/collections/forms/create-post', ['collection' => $collection])@endcomponent
    @endcomponent
  </div>


@endsection
