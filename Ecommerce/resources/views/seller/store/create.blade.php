<!-- resources/views/seller/store/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Store') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-2xl mx-auto mt-10 mb-10 p-8 bg-white shadow-md rounded">
        <form method="POST" action="{{ route('store.store') }}" enctype="multipart/form-data">
            @csrf
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Store Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
    
            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Store Image')" />
                <x-text-input id="image" type="file" name="image" accept="image/*" required />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                
                <div class="mt-4">
                    <img id="image-preview" class="w-32 h-32 object-cover rounded-md" style="display: none;">
                </div>
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4" type="submit">
                    {{ __('Create Store') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', previewImage);

        function previewImage(event) {
            const imageInput = event.target;
            const preview = document.getElementById('image-preview');

            // Cek jika ada file yang diunggah
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                // Setelah file dibaca, atur src dari pratinjau
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Tampilkan elemen gambar
                };

                // Baca file sebagai URL data
                reader.readAsDataURL(imageInput.files[0]);
            }
        }
    </script>
</x-app-layout>
