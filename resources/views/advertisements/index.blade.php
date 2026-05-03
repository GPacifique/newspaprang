<x-app-layout>
@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">📢 Advertisements</h1>

        <a href="{{ route('advertisements.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Advertisement
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Company</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Dates</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($advertisements as $ad)
                    <tr class="border-b">

                        <td class="p-3 font-semibold">
                            {{ $ad->title }}
                        </td>

                        <td class="p-3">
                            {{ $ad->company_name }}
                        </td>

                        <td class="p-3">
                            @if($ad->is_active)
                                <span class="text-green-600 font-bold">Active</span>
                            @else
                                <span class="text-red-600 font-bold">Inactive</span>
                            @endif
                        </td>

                        <td class="p-3 text-sm text-gray-600">
                            {{ $ad->start_date }} → {{ $ad->end_date }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('advertisements.edit', $ad->id) }}"
                               class="text-blue-600">
                                Edit
                            </a>

                            <form action="{{ route('advertisements.destroy', $ad->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this ad?')">

                                @csrf
                                @method('DELETE')

                                <button class="text-red-600">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @empty

                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No advertisements found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection
</x-app-layout>