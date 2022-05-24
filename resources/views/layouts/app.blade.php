<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-700">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-gray-700 text-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
        </div>
        <div class="fixed static bottom-0 flex left-0 bg-gray-500 flex w-full text-white">
            <div class="mx-2">
                @php($today = Carbon\Carbon::now())
                <small>&copy; Copyright {{$today->format('Y')}}, Fooxiie</small>
            </div>
            <div class="absolute flex inset-y-0 right-0 align-middle mx-2 flex">
                <div class="mx-2">
                    <a href="{{Route('bug.report', ['page_reported' => Illuminate\Support\Facades\Route::current()->uri()])}}"
                       class="underline bg-gray-700 p-1 m-2">Signaler un bug</a>
                </div>
                <div>
                    <small>V1.0.1</small>
                </div>
            </div>
        </div>
    </body>
</html>
