@extends('layouts.app')

@section('content')

  <div class="has-margin-bottom">
    <div class="tabs">
      <ul>
        <li><a href="{{ action('CollectionController@show', $collection['id']) }}">General</a></li>
        <li class="is-active"><a href="{{ action('CollectionController@collectionPosts', $collection['id']) }}">Posts</a></li>
        <li><a href="{{ action('CollectionController@edit', $collection['id']) }}">Manage fields</a></li>
      </ul>
      <ul class="is-right">
        <li>
          <a class="button toggle-modal-create-post">New Post</a>
        </li>
        <li>
          <a class="no-link">
            @component('dashboard/components/_search', [
              'model' => $posts,
              'searchQuery' => app('request')->input('s'),
              ])@endcomponent
          </a>
        </li>
      </ul>
    </div>
  </div>


  <div class="page-content">

    <div class="columns">

      <div class="column">

        @component('dashboard/components/minis/_no-results', ['items' => $posts, 'name' => 'posts'])
          <form id="delete-multiple-posts-form" action="{{ action('PostController@setInactiveMultiple') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
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
        @endcomponent


      </div>

    </div>

    @component('dashboard/components/minis/_modal', ['switchClass' => 'toggle-create-post', 'position' => 'is-top'])
      @component('dashboard/collections/forms/create-post', ['collection' => $collection])@endcomponent
      @endcomponent

    </div>



  @component('dashboard/components/_pagination', [
    'model' => $posts,
    'controller' => 'CollectionController',
    'method' => 'collectionPosts',
    'queries' => ['s' => app('request')->input('s')]
    ])@endcomponent


@endsection
