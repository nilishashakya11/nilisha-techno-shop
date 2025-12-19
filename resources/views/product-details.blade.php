<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }} - Details
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="flex flex-col md:flex-row p-8 gap-12">
                    
                    <div class="md:w-1/2 flex items-center justify-center bg-gray-50 rounded-2xl p-6">
                        <img 
                            src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset($product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="max-h-[450px] object-contain drop-shadow-2xl"
                            onerror="this.src='https://placehold.co/600x600?text=Image+Coming+Soon'"
                        >
                    </div>

                    <div class="md:w-1/2 flex flex-col justify-center">
                        <h1 class="text-4xl font-black text-gray-900 leading-tight">
                            {{ $product->name }}
                        </h1>
                        
                        <p class="text-3xl font-bold text-orange-600 mt-4">
                            Rs. {{ number_format($product->price) }}
                        </p>

                        <div class="mt-8 space-y-4">
                            <div class="flex border-b border-gray-100 py-3">
                                <span class="text-gray-500 font-bold uppercase text-xs w-32 tracking-wider">RAM</span>
                                <span class="text-gray-800 font-semibold">{{ $product->ram ?? 'N/A' }}</span>
                            </div>
                            <div class="flex border-b border-gray-100 py-3">
                                <span class="text-gray-500 font-bold uppercase text-xs w-32 tracking-wider">Storage</span>
                                <span class="text-gray-800 font-semibold">{{ $product->storage ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-gray-500 font-bold uppercase text-xs tracking-wider mb-3">Description</h3>
                            <div class="text-gray-700 leading-relaxed bg-orange-50/30 p-4 rounded-xl border border-orange-100/50">
                                {{ $product->description ?? 'No detailed description available for this product yet.' }}
                            </div>
                        </div>

                        <div class="mt-10 flex gap-4">
                            <button class="flex-1 bg-orange-600 hover:bg-orange-700 text-white py-4 rounded-2xl font-black text-lg shadow-lg shadow-orange-200 transition-all active:scale-95">
                                Buy Now
                            </button>
                            <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-4 rounded-2xl font-black text-lg text-center transition-all">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</x-app-layout>