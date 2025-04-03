<x-dashboard-layout>
    <x-slot:heading>Contact Submissions</x-slot:heading>

    <div class="p-8 space-y-8">
        <!-- Header Section with Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Contact Submissions</h2>
            </div>
        </div>

        <!-- Contact Submissions Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                @if($contacts->count() > 0)
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Message</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Submitted At</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($contacts as $contact)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $contact->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $contact->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="max-w-md overflow-hidden">
                                            {{ Str::limit($contact->message, 100) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-500 text-lg">No contact submissions found.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination Links -->
            <div class="mt-4 px-6 py-3 border-t border-gray-100">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>