<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Livewire | @yield('title')</title>

        @include('layouts.style')

        @livewireStyles
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @include('layouts.navbar')
            @include('layouts.sidebar')

            @include('layouts.sidebar')

            @yield('content')

            @include('layouts.footer')
        </div>
        <!-- ./wrapper -->

        @include('layouts.script')

        @livewireScripts
    </body>
</html>
