@extends('layouts.app')

@section('content')


  @component('dashboard/pages/forms/minis/_tabs', ['page' => $page, 'isActive' => 'general'])@endcomponent

  <div class="page-content">
    @include('dashboard/pages/forms/update-general')
  </div>


@endsection
