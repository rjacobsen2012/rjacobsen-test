<!DOCTYPE html>
<html lang="en">
<head>
    @section('header')
        @include('layouts.header')
    @show

    @section('styles')
        @include('layouts.styles')
    @show
</head>
<body id="app-layout">
    <div id="app" class="outer h-100">
        <div class="container-fluid h-100">
            @section('nav')
                @include('layouts.nav')
            @show
            @yield('content')
        </div>
    </div>

@include('layouts.loader')

@section('scripts')
    @include('layouts.scripts')
@show
</body>
</html>
