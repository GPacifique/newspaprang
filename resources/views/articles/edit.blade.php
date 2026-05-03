<form method="POST" action="{{ route('articles.update', $article) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $article->title }}" class="border p-2 w-full"><br><br>

    <textarea name="content" class="border p-2 w-full">
        {{ $article->content }}
    </textarea><br><br>

    <button class="bg-blue-500 text-white px-4 py-2">Update</button>
</form>