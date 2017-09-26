@extends('layouts.app')

@section('content')

  @component('dashboard/pages/forms/minis/_tabs', ['page' => $page, 'isActive' => 'settings'])@endcomponent

  <div class="page-content">
    
  </div>


@endsection
