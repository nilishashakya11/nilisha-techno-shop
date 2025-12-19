<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-10 rounded-3xl shadow-xl text-center border border-gray-100">
            <div class="mb-6 inline-flex items-center justify-center w-20 h-20 bg-green-100 text-green-600 rounded-full">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-3xl font-black text-gray-900 mb-2">Order Placed!</h2>
            <p class="text-gray-500 mb-8 leading-relaxed">
                Thank you for shopping at **Nilisha Techno Shop**. Your order is being processed and will be shipped soon.
            </p>

            <div class="space-y-4">
                <a href="{{ route('dashboard') }}" class="block w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    Back to Shop
                </a>
                <p class="text-xs text-gray-400">A confirmation email has been sent to {{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</x-app-layout>