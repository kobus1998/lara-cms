@extends('layouts.app')

@section('content')

  <h4 class="title has-text-left"><a href="{{ action('MediaController@index') }}">Media</a></h4>
  <h5 class="subtitle"><a href="{{ action('MediaController@show', $media['id']) }}">{{ $media['name'] }}</a></h5>


  <div class="images">


    <div class="card box column is-one-third">
      <div class="card-image">
        <img class="image" src="{{ $media['url'] }}" alt="{{ $media['slug'] }}">
      </div>
    </div>

  </div>

@endsection
