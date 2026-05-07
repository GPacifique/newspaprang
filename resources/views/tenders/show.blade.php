<x-app-layout/>
    <div class="container mx-auto p-6 max-w-4xl">

    <!-- Title -->
    <h1 class="text-3xl font-bold mb-4">
        {{ $tender->title }}
    </h1>

    <!-- Image -->
    <div class="mb-6">
        <img 
            src="{{ $tender->logo_path ? asset('storage/' . $tender->logo_path) : asset('images/default.png') }}"
            class="w-full max-h-80 object-cover rounded-lg shadow"
            alt="Tender Image"
        >
    </div>

    <!-- Details Card -->
    <div class="bg-white shadow rounded-lg p-5 space-y-3">

        <p>
            <strong>Organization:</strong>
            {{ $tender->organization_name }}
        </p>

        <p>
            <strong>Description:</strong><br>
            {{ $tender->description }}
        </p>

        <p>
            <strong>Start Date:</strong>
            {{ $tender->created_at->format('Y-m-d') }}
        </p>

        <p>
            <strong>Deadline:</strong>
            <span class="text-red-600 font-bold">
                {{ $tender->deadline }}
            </span>
        </p>

        <p>
            <strong>Status:</strong>
            @if($tender->status === 'active')
                <span class="text-green-600 font-bold">Active</span>
            @else
                <span class="text-gray-600 font-bold">Closed</span>
            @endif
        </p>

    </div>

    <!-- Document -->
    @if($tender->document)
        <div class="mt-6">
            <a href="{{ asset('storage/' . $tender->document) }}"
               target="_blank"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Download Document
            </a>
        </div>
    @endif

    <!-- Back -->
    <div class="mt-6">
        <a href="{{ route('tenders.index') }}" class="text-blue-600 hover:underline">
            ← Back to Tenders
        </a>
    </div>

</div>