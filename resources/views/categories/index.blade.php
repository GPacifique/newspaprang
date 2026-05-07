<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">📁 Categories</h1>
            <p class="text-gray-500">Manage all article categories</p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">
            + New Category
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold text-slate-700">All Categories</h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-slate-50 text-slate-600 text-sm uppercase">
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Slug</th>
                        <th class="p-4">Created At</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($categories as $category)

                    <tr class="border-b hover:bg-slate-50 transition">

                        <td class="p-4 font-semibold text-slate-700">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-4 font-medium text-slate-800">
                            {{ $category->name }}
                        </td>

                        <td class="p-4 text-gray-500">
                            {{ $category->slug }}
                        </td>

                        <td class="p-4 text-gray-500">
                            {{ $category->created_at->format('d M Y') }}
                        </td>

                        <td class="p-4 text-right">

                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center p-10 text-gray-500">
                            No categories found.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>