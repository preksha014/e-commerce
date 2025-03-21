<x-dashboard-layout>
    <x-slot:heading>Customers</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <h2 class="text-2xl font-bold text-gray-700">Customers Management</h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-300 text-left text-gray-700">
                        <th class="py-3 px-4 border border-gray-300 text-left">Name</th>
                        <th class="py-3 px-4 border border-gray-300 text-left">Email</th>
                        <th class="py-3 px-4 border border-gray-300 text-left">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        @foreach ($customer->address as $address)
                            <tr class="even:bg-gray-100 hover:bg-gray-200 transition text-gray-700">
                                <td class="py-3 px-4 border border-gray-300">{{ $customer->name }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $customer->email }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $address->city }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $customers->links() }}
        </div>
        
    </div>
</x-dashboard-layout>
