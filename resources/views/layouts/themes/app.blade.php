<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('layouts.themes.scripts')

        <!-- Styles -->
        @livewireStyles

    </head>
    <body class="font-sans antialiased">

        {{-- head --}}
        @include('layouts.themes.navBar')

        {{-- sidebar --}}
        @include('layouts.themes.sideBar')

        {{-- contenido --}}
        @include('layouts.themes.content')

        @stack('modals')

        @livewireScripts
        <x-livewire-alert::flash />
    </body>
</html>
