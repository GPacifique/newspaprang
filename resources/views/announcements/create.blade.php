@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Create Announcement</h1>

        <form method="POST" action="{{ route('announcements.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Title</label>
                <input type="text"
                       name="title"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Organization Name</label>
                <input type="text"
                       name="organization_name"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Content</label>
                <textarea name="content"
                          rows="6"
                          class="w-full border rounded p-2"
                          required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Type</label>
                <select name="type" class="w-full border rounded p-2">
                    <option value="public_notice">Public Notice</option>
                    <option value="job">Job</option>
                    <option value="event">Event</option>
                    <option value="obituary">Obituary</option>
                    <option value="legal_notice">Legal Notice</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Expiry Date</label>
                <input type="date"
                       name="expiry_date"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Announcement
            </button>
        </form>
    </div>

</div>
@endsection