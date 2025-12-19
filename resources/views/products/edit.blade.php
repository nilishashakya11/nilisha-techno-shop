<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                
                <form action="{{ route('product.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="space-y-6">
                        <div>
                            <label class="block font-bold text-gray-700">Product Name</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700">Price (Rs.)</label>
                            <input type="number" name="price" value="{{ $product->price }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                        </div>

                        <div class="mt-4">
    <x-input-label for="stock" :value="__('Inventory Stock')" />
    <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $product->stock ?? 0)" required />
</div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-gray-700">RAM</label>
                                <input type="text" name="ram" value="{{ $product->ram }}" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="e.g. 8GB">
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700">Storage</label>
                                <input type="text" name="storage" value="{{ $product->storage }}" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="e.g. 256GB">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700">Image URL</label>
                            <input type="text" name="image" value="{{ $product->image }}" class="w-full border-gray-300 rounded-md shadow-sm">
                            <p class="text-xs text-gray-500 mt-1">Current: {{ $product->image }}</p>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700">Description</label>
                            <textarea name="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500">{{ $product->description }}</textarea>
                        </div>

                        <div class="flex justify-between items-center pt-6 border-t">
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">Cancel</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                                Update Product
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>