@extends('layouts.app')

@section('content')

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        @component('dashboard/components/_bread-crumb', ['navs' => [
            ['name' => 'Media', 'action' => action('MediaController@index'), 'active' => false],
            ['name' => $media['name'], 'action' => action('MediaController@show', $media['id']), 'active' => true]
          ]])

        @endcomponent
        {{-- <h4 class="title is-4 has-text-left">Media ({{$totalItems}})</h4> --}}
      </div>
    </div>
    <div class="level-right">
    </div>
  </div>

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
