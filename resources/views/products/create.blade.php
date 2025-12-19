<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Mobile Phone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Phone Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500" placeholder="e.g. iPhone 16 Pro" required>
                    </div>
                    <div class="mb-4">
    <x-input-label for="stock" :value="__('Inventory Stock')" />
    <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $product->stock ?? 0)" required />
</div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Price (Rs.)</label>
                        <input type="number" name="price" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500" placeholder="150000" required>
                    </div>
                    <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
    <textarea 
        name="description" 
        rows="4" 
        class="w-full border-gray-300 rounded-md shadow-sm"
        placeholder="Enter phone features, warranty info, etc..."
    >{{ isset($product) ? $product->description : '' }}</textarea>
</div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">RAM</label>
                            <input type="text" name="ram" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="8GB">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Storage</label>
                            <input type="text" name="storage" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="256GB">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">Cancel</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md shadow">
                            Save Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>