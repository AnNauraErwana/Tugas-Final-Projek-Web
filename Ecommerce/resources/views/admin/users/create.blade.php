<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New User') }}
        </h2>
    </x-slot>
<div class="container mx-auto p-4">
    <!-- <h1 class="text-2xl font-bold mb-4">Create New User</h1> -->

    <!-- Flash Message -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="border p-2 rounded w-full" value="{{ old('name') }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border p-2 rounded w-full" value="{{ old('email') }}" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700">Role</label>
            <select name="role" id="role" class="border p-2 rounded w-full" required>
                <option value="" disabled selected>Select role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700">Address</label>
            <input type="text" name="address" id="address" class="border p-2 rounded w-full" value="{{ old('address') }}">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create User</button>
        </div>
    </form>
</div>
</x-app-layout>
