<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
     <x-navigation/>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10 bg-white p-6 shadow rounded">

    <h1 class="text-3xl font-bold">
        Welcome, {{ auth()->user()->name }}
    </h1>

    <p class="text-gray-600 mt-2">
        You are logged in as:
        <span class="font-semibold text-black">
            {{ auth()->user()->getRoleNames()->first() }}
        </span>
    </p>

    <hr class="my-6">

    <!-- ROLE BASED SECTION -->
    @if(auth()->user()->hasRole('admin'))
        <div class="bg-red-100 p-4 rounded">
            <h2 class="text-xl font-bold text-red-700">Admin Panel</h2>
            <a href="/admin/dashboard" class="text-blue-600">Go to Admin Dashboard →</a>
        </div>
    @endif

    @if(auth()->user()->hasRole('editor'))
        <div class="bg-blue-100 p-4 rounded">
            <h2 class="text-xl font-bold text-blue-700">Editor Panel</h2>
            <a href="/editor/dashboard" class="text-blue-600">Go to Editor Dashboard →</a>
        </div>
    @endif

    @if(auth()->user()->hasRole('journalist'))
        <div class="bg-green-100 p-4 rounded">
            <h2 class="text-xl font-bold text-green-700">Journalist Panel</h2>
            <a href="/journalist/dashboard" class="text-blue-600">Go to Journalist Dashboard →</a>
        </div>
    @endif

    <!-- GENERAL LINKS -->
    <div class="mt-6 space-y-2">
        <a href="/" class="text-blue-600 block">← Go to Homepage</a>
       
        <a href="/profile" class="text-red-600 block">Edit Profile</a>
    </div>

</div>

</body>
</html>
</x-app-layout>