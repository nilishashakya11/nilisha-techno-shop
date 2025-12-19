<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Categories</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                <form action="{{ route('categories.store') }}" method="POST" class="mb-6 flex gap-4">
                    @csrf
                    <x-text-input name="name" placeholder="Category Name (e.g. Samsung)" class="w-full" required />
                    <x-primary-button>Add Category</x-primary-button>
                </form>

                <hr class="mb-6">

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b p-2">Name</th>
                            <th class="border-b p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="border-b p-2">{{ $category->name }}</td>
                            <td class="border-b p-2">
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>