@extends('layouts.app')

@section('content')

  {{-- <h4 class="title has-text-left"><a href="{{ action('MediaController@index') }}">Media</a></h4> --}}
  <h5 class="subtitle is-white has-padding"><a href="{{ action('MediaController@show', $media['id']) }}">{{ $media['name'] }}</a></h5>

  <div class="page-content is-white has-padding">

    <div class="columns">

      <div class="column is-9">
        <div>
          <img src="{{$media->original}}" alt="{{ $media->alt }}">
        </div>
      </div>
      <div class="column is-3" style="flex-grow: 1;">
        <div>
          <ul>
            <li><b>Name:</b> {{$media->name}}</li>
            <li><b>File Type:</b> {{$media->file_type}}</li>
            <li><b>Uploaded at:</b> {{$media->created_at}}</li>
            <li><b>Size:</b> {{number_format($media->file_size / 1024 / 1024, 2)}} MB</li>
            @if (strpos($media->file_type, 'image') !== false)
              <li><b>Width:</b> {{$media->file_width}}</li>
              <li><b>Height:</b> {{$media->file_height}}</li>
            @endif
          </ul>
        </div>
        <hr>
        @include('dashboard/media/forms/update-form')
      </div>

    </div>

  </div>

@endsection
