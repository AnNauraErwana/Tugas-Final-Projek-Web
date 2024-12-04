<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">

        <!-- Flash Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New User Button -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 flex flex-col md:flex-row md:items-center">
                <input type="text" name="search" placeholder="Search by name, email, or role" class="border p-2 rounded w-full md:w-1/2" value="{{ request()->get('search') }}">
                <button type="submit" class="mt-2 md:mt-0 md:ml-2 bg-brown text-white p-2 rounded hover:bg-brown2">Search</button>
            </form>
            <a href="{{ route('admin.users.create') }}" class="bg-brown text-white px-4 py-2 rounded hover:bg-brown2">
                Add New User
            </a>
        </div>

        <!-- User Table -->
        <div class="bg-white shadow-md rounded">
            <table class="min-w-full border-collapse border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
