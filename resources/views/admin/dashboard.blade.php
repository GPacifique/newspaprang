<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between"><x-application-logo class="w-12 h-12 fill-current text-gray-500" />  
        <h1 class="text-3xl font-bold">👑 Admin Control Center</h1>
        <a href="/dashboard" class="text-blue-600">← Back to User Dashboard</a>
    </div>
    <hr class="my-6">
    <h1 class="text-3xl font-bold">👑 Admin Control Center</h1>

    <div class="grid grid-cols-3 gap-4 mt-6">

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Users</h2>
            <p class="text-2xl">{{ $users ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Admins</h2>
            <p class="text-2xl">{{ $admins ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Editors</h2>
            <p class="text-2xl">{{ $editors ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Journalists</h2>
            <p class="text-2xl">{{ $journalists ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Articles</h2>
            <p class="text-2xl">{{ $articles_total ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Published</h2>
            <p class="text-2xl">{{ $published ?? 0 }}</p>
        </div>

    </div>

</div>

</body>
</html>
</x-app-layout>