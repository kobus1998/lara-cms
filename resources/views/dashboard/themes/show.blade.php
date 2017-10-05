@extends('layouts.app')

@section('content')

  <div class="page-content has-padding is-white">
    <h3 class="title is-3">{{ $theme['name'] }}</h3>
    <ul>
      <li>Author: {{ $theme['author'] }}</li>
      <li>{{ $theme['desc'] }}</li>
    </ul>
  </div>

@endsection
