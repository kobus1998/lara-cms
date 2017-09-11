@extends('layouts.app')

@section('content')

  <div class="level">
    <div class="level-left">
      <div class="level-item">
        <h4 class="title is-4 has-text-left">Upload Media</h4>
      </div>
    </div>
  </div>
  <hr>
  <div class="media-upload">

    <form class="" action="{{ action('MediaController@store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{-- <div class="field is-horizontal">
        <div class="field-label">
          <label for="name">Name</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="text" name="name" class="input">
            </div>
          </div>
        </div>
      </div> --}}
      <div class="field is-horizontal">
        <div class="field-label">
          <label for="media">Files</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input type="file" name="media[]" multiple />
            </div>
          </div>
        </div>
      </div>
      <div class="field is-horizontal">
        <div class="field-label">
          <label for=""></label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-primary">Upload</button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>

@endsection
