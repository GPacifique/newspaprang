<x-app-layout/>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Available Tenders
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-6">Available Tenders</h1>

    @foreach($tenders as $tender)
        <div class="flex gap-4 border rounded-lg p-4 mb-4 shadow-sm bg-white">

            <!-- Image -->
            <div class="w-32 h-24 flex-shrink-0">
                <img 
                    src="{{ $tender->logo_path ? asset('storage/' . $tender->logo_path) : asset('images/default.png') }}" 
                    class="w-full h-full object-cover rounded"
                    alt="Tender Image"
                >
            </div>

            <!-- Content -->
            <div class="flex-1">

                <h2 class="text-lg font-semibold">
                    {{ $tender->title }}
                </h2>

                <p class="text-gray-600 text-sm mt-1">
                    {{ \Illuminate\Support\Str::limit($tender->description, 120) }}
                </p>

                <div class="mt-2 text-sm text-gray-500 flex gap-4">

                    <span>
                        <strong>Start:</strong> 
                        {{ $tender->created_at->format('Y-m-d') }}
                    </span>

                    <span>
                        <strong>End:</strong> 
                        {{ $tender->deadline }}
                    </span>

                </div>

                <div class="mt-3">
                    <a href="{{ route('tenders.show', $tender->id) }}"
                       class="text-blue-600 hover:underline text-sm">
                        View Details →
                    </a>
                </div>

            </div>

        </div>
    @endforeach

    <!-- Pagination -->
    <div class="mt-6">
        {{ $tenders->links() }}
    </div>

</div>
