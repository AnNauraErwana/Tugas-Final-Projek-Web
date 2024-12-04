<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 mb-10 p-8 bg-white shadow-md rounded">
        <form method="POST" action="{{ route('seller.store.update', $store->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Store Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $store->name }}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" rows="5" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description">{{ old('description', $store->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
    
            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Store Image')" />
                
                <!-- Display current image if exists -->
                @if($store->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $store->image) }}" alt="Store Image" class="w-32 h-32 object-cover rounded-md" />
                    </div>
                @endif
                
                <!-- File input to upload new image -->
                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" onchange="previewImage(event)" autocomplete="new-image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                
                <!-- Display the selected image preview -->
                <div id="imagePreview" class="mt-2"></div>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    <a href="{{'seller.store.index'}}"></a>{{ __('Update Store') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript function to show a preview of the image selected
        function previewImage(event) {
            const previewDiv = document.getElementById('imagePreview');
            previewDiv.innerHTML = ''; // Clear any previous previews
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('w-32', 'h-32', 'object-cover', 'rounded-md');
                    previewDiv.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
