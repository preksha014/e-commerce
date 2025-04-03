<x-dashboard-layout>
    <x-slot:heading>Admins</x-slot:heading>

    <div class="p-8 space-y-8">
        <!-- Header Section with Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Admins Management</h2>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.admins.create') }}"
                    class="px-4 py-2 bg-violet-50 text-violet-600 rounded-lg hover:bg-violet-100 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Admin
                </a>
            </div>
        </div>

        @if(session('success'))
            <script>
                $(document).ready(function () {
                    toastr.success("{{ session('success') }}");
                });
            </script>
        @endif

        <!-- Admins Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $admin->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($admin->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->role->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                            class="p-2 bg-violet-50 text-violet-600 rounded-lg hover:bg-violet-100 transition-colors duration-200">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors duration-200"
                                            data-action-open data-id="{{ $admin->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $admins->links() }}
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
                <p class="text-gray-600">Do you really want to delete this admin? This action cannot be undone.</p>
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
    </div>
</x-dashboard-layout>

<script>
    $(document).ready(function () {
        // Open modal and set admin ID
        $('[data-action-open]').click(function () {
            var adminId = $(this).data('id');
            $('#deleteForm').attr('action', '/admins/' + adminId + '/delete');
            $('#deleteModal').removeClass('hidden');
        });
a
        // Close modal
        $('#cancelDelete').click(function () {
            $('#deleteModal').addClass('hidden');
        });
    });
</script>