@extends('layouts.app')

@section('content')

  <div class="container is-fluid">
    <h4 class="title is-4">{{ $page['page_name'] }}</h4>
    <nav>
      <div class="tabs">
        <ul>
          <li data-toggle="general-tab" class="is-active"><a>General</a></li>
          <li data-toggle="content-tab"><a>Content</a></li>
          <li data-toggle="seo-tab"><a>SEO</a></li>
        </ul>
      </div>
    </nav>
    <br>
    <div class="">
      <div class="general-tab toggle-tab is-active">

        <form class="" action="index.html" method="post">

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="page-name">Name</label>
            </div>
            <div class="field-body">
              <p class="control">
                <input class="input" type="text" name="page-name" value="{{ $page['page_name'] }}">
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="page-url">Url</label>
            </div>
            <div class="field-body">
              <p class="control">
                <input class="input" type="text" name="page-url" value="{{ $page['url'] }}">
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="slug">Slug</label>
            </div>
            <div class="field-body">
              <p class="control">
                <input class="input" type="text" name="slug" value="{{ $page['slug'] }}">
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="slug">Type</label>
            </div>
            <div class="field-body">
              <p class="control">
                <span class="select">
                  <select name="type">
                    <option value=""></option>
                    @foreach ($types as $type)
                      <option value="{{ $type->id }}" {{ ($type->id === $page->type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                  </select>
                </span>
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="page-desc">Description</label>
            </div>
            <div class="field-body">
              <p class="control">
                <textarea class="textarea" name="page-desc" rows="8" cols="80">{{ $page['page_desc'] }}</textarea>
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label></label>
            </div>
            <div class="field-body">
              <p class="control">
                <button type="submit" class="button is-primary">Update</button>
              </p>
            </div>
          </div>

        </form>

      </div>
      <div class="content-tab toggle-tab">

      </div>
      <div class="seo-tab toggle-tab">
        <form class="" action="index.html" method="post">

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="seo-title">Seo Title</label>
            </div>
            <div class="field-body">
              <p class="control">
                <input type="text" name="seo-title" value="{{ $page->seo_title }}" class="input">
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label for="seo-keywords">Keywords</label>
            </div>
            <div class="field-body">
              <p class="control">
                <input type="text" name="seo-keywords" value="{{ $page->seo_keywords }}" class="input">
              </p>
            </div>
          </div>


          <div class="field is-horizontal">
            <div class="field-label">
              <label for="seo-desc">Seo Description</label>
            </div>
            <div class="field-body">
              <p class="control">
                <textarea name="seo-desc" rows="8" cols="80" class="textarea">
                  {{ $page->seo_desc }}
                </textarea>
              </p>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label">
              <label for=""></label>
            </div>
            <div class="field-body">
              <p class="control">
                <button type="submit" class="button is-primary">Update</button>
              </p>
            </div>
          </div>

        </form>
      </div>
    </div>

  </div>

@endsection
