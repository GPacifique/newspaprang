<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">
        ✏️ Edit Category
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Category Name</label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ $category->name }}"
                   required
                   class="w-full border p-3 rounded"
                   placeholder="Category name">
        </div>

        <!-- SLUG -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Slug</label>
            <input type="text"
                   name="slug"
                   id="slug"
                   value="{{ $category->slug }}"
                   class="w-full border p-3 rounded bg-gray-100"
                   readonly>
        </div>

        <!-- BUTTONS -->
        <div class="flex items-center gap-3">

            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Update Category
            </button>

            <a href="{{ route('categories.index') }}"
               class="text-gray-600">
                Cancel
            </a>

        </div>
    </form>
</div>

<!-- AUTO SLUG UPDATE -->
<script>
document.getElementById('name').addEventListener('input', function () {
    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

    document.getElementById('slug').value = slug;
});
</script>

</body>
</html>
</x-app-layout>