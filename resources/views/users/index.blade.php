<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-800">👥 Users</h1>
    </div>

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-50 text-left text-sm uppercase text-slate-600">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">Profile Photo</th>
                    <th class="p-4">Name </th>  
                    <th class="p-4">Email</th>
                    <th class="p-4">Username</th>
                    <th class="p-4">Phone</th>
                    <th class="p-4">Role</th>
                    <th class="p-4">Created</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($users as $user)

                <tr class="border-b hover:bg-slate-50">
                    <td class="p-4">{{ $loop->iteration }}</td>
                    <td class="p-4">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full">
                    </td>   
                    <td class="p-4 font-medium">{{ $user->name }}</td>
                    <td class="p-4 text-gray-500">{{ $user->email }}</td>
                    <td class="p-4">{{ $user->username }}</td>
                    <td class="p-4">{{ $user->phone }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                            {{ $user->role ?? 'User' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm">
                            Edit
                        </a>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500">
                        No users found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>