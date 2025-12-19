<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8">
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-gray-400 uppercase text-sm border-b">
                                    <th class="pb-4">Product</th>
                                    <th class="pb-4">Price</th>
                                    <th class="pb-4">Quantity</th>
                                    <th class="pb-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php $total = 0 @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr>
                                        <td class="py-6">
                                            <div class="flex items-center">
                                                <img src="{{ $details['image'] }}" class="w-16 h-16 object-contain rounded-lg bg-gray-50 p-2 mr-4">
                                                <span class="font-bold text-gray-800">{{ $details['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-6 font-medium">Rs. {{ number_format($details['price']) }}</td>
                                        <td class="py-6">{{ $details['quantity'] }}</td>
                                        <td class="py-6 text-right">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-10 border-t pt-8 flex flex-col items-end">
                        <div class="w-full md:w-1/3">
                            <div class="flex justify-between text-gray-600 mb-2">
                                <span>Subtotal</span>
                                <span>Rs. {{ number_format($total) }}</span>
                            </div>
                            <div class="flex justify-between text-2xl font-black text-gray-900 mb-6">
                                <span>Total</span>
                                <span>Rs. {{ number_format($total) }}</span>
                            </div>

                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    Proceed to Checkout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Your cart is empty</h3>
                        <p class="mt-1 text-gray-500">Look for some amazing phones in our shop!</p>
                        <div class="mt-6">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Go to Shop
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>