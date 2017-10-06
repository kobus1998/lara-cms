@extends('layouts.app')

@section('content')

  <div class="page-content has-padding is-white">

    <h3 class="title is-3">Themes</h3>

    <hr>

    <form class="" action="{{ action('ThemeController@store') }}" method="post">
      {{ csrf_field() }}
      <div class="field has-addons">
        <label class="has-margin-right">New Theme</label>
        <div class="control has-input">
          <input type="text" name="name" value="" class="input">
        </div>
        <div class="control">
          <button type="submit" class="button is-primary">Create</button>
        </div>
      </div>
    </form>

    <hr>

    <table class="table is-striped">
      <thead>
        <th>Name</th>
      </thead>
      <tbody>
        @foreach ($themes as $theme)
          @php
            $slug = str_replace(' ', '-', $theme['name']);
          @endphp
          <tr>
            <td><a href="{{ action('ThemeController@show', $slug) }}">{{ $theme['name'] }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>

@endsection
