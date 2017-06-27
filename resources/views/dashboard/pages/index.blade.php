@extends('layouts.app')

@section('content')

  <div class="overview">
    <h4 class="title is-4">Pages</h4>
    <table class="table table-striped is-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Url</th>
          <th>Type</th>
          <th>Last Modified</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pages as $page)
          <tr data-href="{{ action('PageController@show', $page['id']) }}" class="redirecter">
            <td>{{ $page['id'] }}</td>
            <td>{{ $page['page_name'] }}</td>
            <td>{{ $page['url'] }}</td>
            <td>{{ $page['type']['name'] }}</td>
            <td>{{ $page['updated_at'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>

@endsection
