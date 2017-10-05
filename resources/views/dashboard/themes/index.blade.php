@extends('layouts.app')

@section('content')

  <div class="page-content has-padding is-white">

    <h3 class="title is-3">Themes</h3>

    <hr>

    <form class="" action="{{ action('ThemeController@store') }}" method="post">
      {{ csrf_field() }}

      <input type="text" name="name" value="">
      <textarea name="desc" rows="8" cols="80"></textarea>
      <button type="submit" name="button">s</button>

    </form>

    {{-- <table class="table is-striped">
      <thead>
        <th>Name</th>
        <th>Author</th>
        <th>Description</th>
      </thead>
      <tbody>
        @foreach ($themes as $theme)
          @php
            $slug = str_replace(' ', '-', $theme['name']);
          @endphp
          <tr>
            <td><a href="{{ action('ThemeController@show', $slug) }}">{{ $theme['name'] }}</a></td>
            <td>{{ $theme['author'] }}</td>
            <td>{{ $theme['desc'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table> --}}

  </div>

@endsection
