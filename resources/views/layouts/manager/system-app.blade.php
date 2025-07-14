<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/css/common.css', 'resources/js/manager_app.js', 'resources/scss/manager/main.scss'])
    @stack('scripts')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.manager.header')

        {{-- Page Content --}}
        <main class="flex">
            @include('layouts.manager.side-menu')

            <div class="display-area">
                {{-- 画面名 --}}
                <div class="screen-name">
                    {{ $view_name }}
                </div>

                {{-- フラッシュメッセージ --}}
                @include('layouts.manager.flash_message')

                {{-- コンテンツ --}}
                <div class="main-content-area">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>
