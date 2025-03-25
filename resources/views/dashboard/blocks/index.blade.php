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

        @if(session('success'))
            <script>
                $(document).ready(function () {
                    toastr.success("{{ session('success') }}");
                });
            </script>
        @endif

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
                                    class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition duration-200">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200"
                                    data-action-open data-slug="{{ $block->slug }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
                <p class="text-gray-600">Do you really want to delete this block? <br /> This action cannot be undone.
                </p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button id="cancelDelete"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
</x-dashboard-layout>

<script>
    $(document).ready(function () {
        // Open modal and set block slug
        $('[data-action-open]').click(function () {
            var slug = $(this).data('slug');
            $('#deleteForm').attr('action', '/admin/block/' + slug + '/delete');
            $('#deleteModal').removeClass('hidden');
        });

        // Close modal
        $('#cancelDelete').click(function () {
            $('#deleteModal').addClass('hidden');
        });
    });
</script>