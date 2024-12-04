<x-app-layout>
 

    <!-- Header Section -->
    <x-slot name="header">

    
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
        <div class="flex justify-between mb-4">
            <!-- Search Form -->
            <form action="{{ route('products.search') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Products..." class="px-4 py-2 border rounded-lg w-64">
                <button type="submit" class="bg-brown text-white px-4 py-2 rounded-lg hover:bg-brown2">Search</button>
            </form>
        </div>
    </x-slot> 

    <!-- Main Content Section -->
    <div class="max-w-4xl mx-auto mt-10 mb-10">
        <!-- Image Carousel -->
        <div x-data="{ currentImage: 0, images: [
            'https://i.pinimg.com/736x/19/e9/19/19e919f85994e2040c99f57601467dbf.jpg',
            'https://i.pinimg.com/736x/b5/0b/9f/b50b9fe0be224b4d6852321824e735e3.jpg',
            'https://i.pinimg.com/736x/54/d4/54/54d454b0742d3115928e76d356f931e9.jpg',
            'https://i.pinimg.com/736x/0a/1e/3c/0a1e3c704d0b4c1649a24f7935f168df.jpg'
        ] }" class="relative">
            <!-- Display Images -->
            <div class="overflow-hidden rounded-lg">
                <template x-for="(image, index) in images" :key="index">
                    <img :src="image" :alt="'Image ' + (index + 1)" x-show="currentImage === index" class="w-full h-72 object-cover transition-opacity duration-500">
                </template>
            </div>

            <!-- Navigation Buttons -->
            <button @click="currentImage = (currentImage > 0) ? currentImage - 1 : images.length - 1" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full">
                ‹
            </button>
            <button @click="currentImage = (currentImage < images.length - 1) ? currentImage + 1 : 0" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full">
                ›
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <template x-for="(image, index) in images" :key="index">
                    <button @click="currentImage = index" :class="currentImage === index ? 'bg-brown' : 'bg-gray-400'" class="w-3 h-3 rounded-full"></button>
                </template>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-md p-4 transition-transform transform hover:scale-105">
                <!-- Product Image -->
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                
                <!-- Product Name and Price -->
                <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600">{{ number_format($product->price, 2) }}</p>

                <!-- Action Buttons -->
                <div class="mt-4 flex justify-between">
                    <!-- Add to Favorite Button -->
                    <form action="{{ route('buyer.favorites.store', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Add to Favorite
                        </button>
                    </form>

                    <!-- Add to Cart Button -->
                    <form action="{{ route('buyer.cart.store', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-brown text-white px-4 py-2 rounded-lg hover:bg-brown2">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
