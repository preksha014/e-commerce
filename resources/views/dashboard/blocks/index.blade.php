<x-dashboard-layout>
    <x-slot:heading>Settings</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-700">Blocks Management</h2>
            <a href="{{ route('admin.block.create') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                + Add New Block
            </a>
        </div>

        <!-- Settings Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-center">
                <thead>
                    <tr class="bg-violet-300 text-gray-700 text-md">
                        <th class="py-3 px-4 border border-gray-300">Title</th>
                        <th class="py-3 px-4 border border-gray-300">Slug</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                        <th class="py-3 px-4 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $block)
                        <tr class="even:bg-gray-100 text-gray-700">
                            <td class="py-4 px-6 border border-gray-300 text-md font-semibold">{{ $block->title }}</td>
                            <td class="py-3 px-6 border border-gray-300">{{ $block->slug }}</td>
                            <td class="py-3 px-6 border border-gray-300">{{ $block->status }}</td>
                            <td class="py-3 px-4 border border-gray-300 space-x-2">
                                <a href="{{ route('admin.block.edit', $block->slug) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-yellow-600 transition duration-200">
                                    Edit
                                </a>
                                <form action="{{ route('admin.block.destroy', $block->slug) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200"
                                        onclick="return confirm('Are you sure you want to delete this block?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>