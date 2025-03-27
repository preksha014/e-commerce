<x-dashboard-layout>
    <x-slot:heading>Contact Submissions</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-700">Contact Us Submissions</h2>
        </div>

        <!-- Contact Submissions Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-center">
                <thead>
                    <tr class="bg-violet-300 text-gray-700 text-md">
                        <th class="py-3 px-4 border border-gray-300">Name</th>
                        <th class="py-3 px-4 border border-gray-300">Email</th>
                        <th class="py-3 px-4 border border-gray-300">Message</th>
                        <th class="py-3 px-4 border border-gray-300">Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr class="even:bg-gray-100 text-gray-700">
                            <td class="py-4 px-6 border border-gray-300 text-md font-semibold">{{ $contact->name }}</td>
                            <td class="py-3 px-6 border border-gray-300">{{ $contact->email }}</td>
                            <td class="py-3 px-6 border border-gray-300 truncate max-w-xs">{{ Str::limit($contact->message, 50) }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>