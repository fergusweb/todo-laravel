<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Default Title Tag' }}</title>
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="h-full">
    <div class="min-h-screen bg-gray-100">

        <livewire:layout.navigation />

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

                {{ $slot }}

            </div>
        </main>
    </div>

    @vite(['resources/js/app.js'])
    @livewireScripts
</body>

</html>
