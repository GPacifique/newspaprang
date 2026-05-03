<x-app-layout>
    @section('content')
<div class="max-w-4xl mx-auto bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-6">📢 Create Advertisement</h1>

    <form method="POST" action="{{ route('advertisements.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- TITLE -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title"
                   class="w-full border p-2 rounded"
                   placeholder="Ad title">
        </div>

        <!-- COMPANY NAME -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Company Name</label>
            <input type="text" name="company_name"
                   class="w-full border p-2 rounded"
                   placeholder="Company name">
        </div>

        <!-- IMAGE -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Advertisement Image</label>
            <input type="file" name="image"
                   class="w-full border p-2 rounded">
        </div>

        <!-- LINK -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Link (optional)</label>
            <input type="url" name="link"
                   class="w-full border p-2 rounded"
                   placeholder="https://example.com">
        </div>

        <!-- START DATE -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Start Date</label>
            <input type="date" name="start_date"
                   class="w-full border p-2 rounded">
        </div>

        <!-- END DATE -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">End Date</label>
            <input type="date" name="end_date"
                   class="w-full border p-2 rounded">
        </div>

        <!-- ACTIVE -->
        <div class="mb-4 flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" checked>
            <label class="font-semibold">Active</label>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Advertisement
            </button>
        </div>

    </form>

</div>
@endsection
</x-app-layout>