<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nilisha Techno Shop') }}
            </h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('product.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-700 transition">
                    + Add Product
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <h3 class="text-2xl font-bold mb-6 text-gray-800">Shop by Brand</h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                @foreach($categories as $category)
                    <a href="{{ route('dashboard', ['category' => $category->id]) }}" class="bg-white p-6 rounded-xl shadow-sm text-center hover:shadow-md transition border border-transparent hover:border-indigo-300">
                        @if(strtolower($category->name) == 'apple')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" class="h-12 mx-auto mb-4">
                        @elseif(strtolower($category->name) == 'samsung')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg" class="h-12 mx-auto mb-4">
                        @else
                            <div class="h-12 flex items-center justify-center mb-4 text-indigo-600 font-black text-xl">
                                {{ $category->name }}
                            </div>
                        @endif
                        <span class="font-bold text-gray-700">{{ $category->name }}</span>
                    </a>
                @endforeach
                
                <a href="{{ route('dashboard') }}" class="bg-gray-200 p-6 rounded-xl shadow-sm text-center hover:bg-gray-300 transition flex flex-col justify-center">
                    <span class="font-bold text-gray-600">All Products</span>
                </a>
            </div>

            <h3 class="text-2xl font-bold mb-6 text-gray-800">
                {{ request('category') ? 'Filtered Results' : 'Featured Phones' }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 flex flex-col">
                        <div class="w-full h-64 bg-white p-4 relative">
                            <img 
                                src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset($product->image) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-contain"
                                onerror="this.src='https://placehold.co/400x400?text=No+Image'"
                            >
                        </div>

                        <div class="p-6 flex-grow border-t border-gray-100">
                            <h4 class="text-xl font-bold">{{ $product->name }}</h4>
                            
                            <p class="mt-1 text-sm">
                                @if($product->stock > 0)
                                    <span class="text-green-600 font-medium">● In Stock ({{ $product->stock }})</span>
                                @else
                                    <span class="text-red-500 font-medium">● Out of Stock</span>
                                @endif
                            </p>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xl font-black text-black">
                                    Rs. {{ number_format($product->price) }}
                                </span>
                                <a href="{{ route('product.details', $product->id) }}" class="text-indigo-600 font-bold hover:underline text-sm">
                                    View Details
                                </a>
                            </div>

                            <div class="mt-5">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                        class="w-full py-3 rounded-xl font-bold transition {{ $product->stock > 0 ? 'bg-black text-white hover:bg-gray-800' : 'bg-gray-200 text-gray-500 cursor-not-allowed' }}"
                                        {{ $product->stock > 0 ? '' : 'disabled' }}>
                                        {{ $product->stock > 0 ? 'Add to Cart' : 'Sold Out' }}
                                    </button>
                                </form>
                            </div>

                            @if(Auth::user()->role === 'admin')
                                <div class="mt-6 flex items-center justify-between border-t pt-4 bg-gray-50 -mx-6 -mb-6 p-4">
                                    <a href="{{ route('product.edit', $product->id) }}" class="text-yellow-600 font-bold hover:text-yellow-700 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-bold hover:text-red-700 text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 italic">No products found for this category.</p>
                        <a href="{{ route('dashboard') }}" class="text-indigo-600 underline mt-2 block">Show all products</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>