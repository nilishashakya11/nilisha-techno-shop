<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Sales & Inventory Report</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm font-bold uppercase">Total Items</h3>
                    <p class="text-3xl font-bold">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <h3 class="text-gray-500 text-sm font-bold uppercase">Total Inventory Value</h3>
                    <p class="text-3xl font-bold">Rs. {{ number_format($totalValue) }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-3">Product Name</th>
                            <th class="pb-3">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="border-b">
                            <td class="py-3">{{ $product->name }}</td>
                            <td class="py-3">Rs. {{ number_format($product->price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>