@extends('layouts.app')

@section('content')

  @component('dashboard/pages/forms/minis/_tabs', ['page' => $page, 'isActive' => 'content'])@endcomponent

  <div class="page-content">
    @include('dashboard/pages/forms/update-content')
  </div>


@endsection
