@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Announcements</h1>

        <a href="{{ route('announcements.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Create Announcement
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3">Title</th>
                    <th class="text-left p-3">Organization</th>
                    <th class="text-left p-3">Type</th>
                    <th class="text-left p-3">Status</th>
                    <th class="text-left p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($announcements as $announcement)
                    <tr class="border-b">
                        <td class="p-3">{{ $announcement->title }}</td>
                        <td class="p-3">{{ $announcement->organization_name }}</td>
                        <td class="p-3">{{ $announcement->type }}</td>
                        <td class="p-3">{{ $announcement->status }}</td>

                        <td class="p-3 space-x-2">
                            <a href="{{ route('announcements.edit', $announcement->id) }}"
                               class="text-blue-600">Edit</a>

                            <form action="{{ route('announcements.destroy', $announcement->id) }}"
                                  method="POST"
                                  class="inline">
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
                        <td colspan="5" class="text-center p-4">
                            No announcements found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection