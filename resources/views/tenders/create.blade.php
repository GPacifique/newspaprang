<x-app-layout>
    <div class="container mx-auto p-6 max-w-3xl">

    <h1 class="text-2xl font-bold mb-6">Create New Tender</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Title -->
        <div>
            <label class="block font-medium">Title</label>
            <input type="text" name="title" class="w-full border p-2 rounded" value="{{ old('title') }}" required>
        </div>

        <!-- Organization -->
        <div>
            <label class="block font-medium">Organization Name</label>
            <input type="text" name="organization_name" class="w-full border p-2 rounded" value="{{ old('organization_name') }}" required>
        </div>

        <!-- Description -->
        <div>
            <label class="block font-medium">Description</label>
            <textarea name="description" rows="5" class="w-full border p-2 rounded" required>{{ old('description') }}</textarea>
        </div>

        <!-- Logo -->
        <div>
            <label class="block font-medium">Logo / Image</label>
            <input type="file" name="logo_path" class="w-full border p-2 rounded">
        </div>

        <!-- Document -->
        <div>
            <label class="block font-medium">Tender Document (PDF)</label>
            <input type="file" name="document" class="w-full border p-2 rounded">
        </div>

        <!-- Deadline -->
        <div>
            <label class="block font-medium">Deadline</label>
            <input type="date" name="deadline" class="w-full border p-2 rounded" required>
        </div>

        <!-- Status -->
        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="active">Active</option>
                <option value="closed">Closed</option>
            </select>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Tender
            </button>
        </div>

    </form>

</div>
</x-app-layout>