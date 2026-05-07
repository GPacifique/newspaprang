
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">📰 Create New Article</h1>

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        @csrf

        <!-- LEFT: CONTENT -->
        <div class="lg:col-span-2 bg-white p-5 shadow rounded">

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TITLE -->
            <input type="text" name="title" required
                   placeholder="Article title..."
                   class="border p-3 w-full mb-4 font-bold text-lg">

            <!-- EXCERPT -->
            <textarea name="excerpt" rows="3"
                      placeholder="Short summary..."
                      class="border p-3 w-full mb-4"></textarea>

            <!-- CONTENT (CKEditor) -->
            <textarea name="content" id="editor" required
                      class="border p-3 w-full h-96"></textarea>

        </div>

        <!-- RIGHT: SETTINGS -->
        <div class="bg-white p-5 shadow rounded">

            <h2 class="font-bold mb-4">⚙️ Settings</h2>

            <!-- CATEGORY -->
            <label class="text-sm font-semibold">Category</label>
            <select name="category_id" class="border p-2 w-full mb-4" required>
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- IMAGE -->
            <label class="text-sm font-semibold">Featured Image</label>
            <input type="file" name="featured_image"
                   class="border p-2 w-full mb-4">

            <!-- FLAGS -->
            <label class="flex items-center gap-2 mb-2">
                <input type="checkbox" name="is_featured">
                Featured
            </label>

            <label class="flex items-center gap-2 mb-4">
                <input type="checkbox" name="is_breaking">
                Breaking News
            </label>

            <!-- STATUS -->
            <label class="text-sm font-semibold">Status</label>
            <select name="status" class="border p-2 w-full mb-4">
                <option value="draft">Draft</option>
                <option value="submitted">Submit for Review</option>
                <option value="published">Publish Now</option>
            </select>

            <!-- SUBMIT -->
            <button class="bg-green-600 text-white w-full py-2 rounded font-bold">
                Save Article
            </button>

        </div>

    </form>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    });
</script>

</body>
</html>