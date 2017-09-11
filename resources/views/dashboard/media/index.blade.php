@extends('layouts.app')

@section('content')

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        <h4 class="title is-4 has-text-left">Media</h4>
      </div>
    </div>
    <div class="level-right">
      <div class="level-item">
        <a href="{{ action('MediaController@upload') }}" class="button has-margin-right">Upload media</a>
      </div>
    </div>
  </div>

  @if (count($images) == 0)

    <div class="notification">
      <div class="content">
        <h4 class="title is-4">
          You don't have uploaded any media yet
          <a class="button is-primary is-pulled-right" href="{{ action('MediaController@upload') }}">Upload media</a>
        </h4>
      </div>
    </div>

  @else

  <div class="media-manager">
    <div class="columns is-multiline">
      @foreach ($images as $image)
        <div class="card box column is-one-third">
          <div class="card-image">
            <img src="{{ $image['url'] }}" alt="">
          </div>
          <div class="card-content">
            <p><a href="{{ action('MediaController@show', $image['id']) }}">{{ $image['name'] }}</a></p>
          </div>
        </div>
      @endforeach
    </div>


  </div>

  @endif

@endsection
