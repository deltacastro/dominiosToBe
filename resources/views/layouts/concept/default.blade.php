@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>@yield('title')</h4>
        @yield('view-body')
    </div>
@endsection