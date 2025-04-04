<x-dashboard-layout>
    <x-slot name="heading">Edit Role</x-slot>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Edit Role</h2>
            <form action="{{ route('admin.role.update',$role->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Role Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name')?? $role->name }}"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs textd-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_super_admin" id="is_super_admin" value="yes"
                               class="rounded border-gray-300 text-violet-500 focus:ring-violet-500"
                               {{ $role->is_super_admin === 'yes' ? 'checked' : '' }}>
                        <span class="ml-2 text-md text-gray-700">Super Admin</span>
                    </label>
                </div>
                <div class="mt-4 space-y-2">
                    <label class="block text-md font-medium text-gray-700">Permissions</label>
                    @foreach($permissions as $permission)
                        <label class="inline-flex items-center block">
                            <input type="checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}"
                                   class="permission-checkbox rounded border-gray-300 text-violet-500 focus:ring-violet-500"
                                   {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <span class="ml-2 text-md text-gray-700">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <a href="{{ route('admin.role') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg shadow-md hover:bg-violet-700 transition duration-200">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const $superAdminCheckbox = $('#is_super_admin');
            const $permissionCheckboxes = $('.permission-checkbox');

            function updatePermissions() {
                if ($superAdminCheckbox.is(':checked')) {
                    $permissionCheckboxes.prop('checked', true).prop('disabled', true);
                } else {
                    $permissionCheckboxes.prop('disabled', false);
                }
            }

            $superAdminCheckbox.on('change', updatePermissions);
            
            updatePermissions();
        });
    </script>
</x-dashboard-layout>