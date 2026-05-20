<x-app-layout>

<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">✏️ Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <input type="text" name="name" value="{{ $user->name }}"
               class="w-full mb-3 border rounded-xl p-2" placeholder="Name">

        {{-- EMAIL --}}
        <input type="email" name="email" value="{{ $user->email }}"
               class="w-full mb-3 border rounded-xl p-2" placeholder="Email">

        {{-- USERNAME --}}
        <input type="text" name="username" value="{{ $user->username }}"
               class="w-full mb-3 border rounded-xl p-2" placeholder="Username">

        {{-- PHONE --}}
        <input type="text" name="phone" value="{{ $user->phone }}"
               class="w-full mb-3 border rounded-xl p-2" placeholder="Phone">

        {{-- ROLE --}}
        <select name="role" class="w-full mb-3 border rounded-xl p-2">
            @foreach(['admin','editor','journalist','advertiser','subscriber','reader'] as $role)
                <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>

        {{-- STATUS --}}
        <select name="status" class="w-full mb-3 border rounded-xl p-2">
            @foreach(['active','inactive','suspended'] as $status)
                <option value="{{ $status }}" {{ $user->status == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        {{-- BIO --}}
        <textarea name="bio" class="w-full mb-3 border rounded-xl p-2">
            {{ $user->bio }}
        </textarea>

        <button class="bg-blue-600 text-white px-5 py-2 rounded-xl">
            Update User
        </button>

    </form>

</div>

</x-app-layout>