<!-- profile-edit.blade.php -->
<x-layout>
    <x-slot:heading>Edit Profile</x-slot:heading>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit Customer Profile</h2>
            <form method="POST" action="{{ route('account.profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->guard('customer')->user()->name) }}" 
                           class="w-full p-2 border border-gray-300 rounded-lg @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->guard('customer')->user()->email) }}" 
                           class="w-full p-2 border border-gray-300 rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Fields -->
                @php
                    $address = auth()->guard('customer')->user()->address->first();
                @endphp

                @if($address)
                    <div class="mb-4">
                        <label for="street" class="block text-gray-700 mb-2">Street</label>
                        <input type="text" name="street" id="street" value="{{ old('street', $address->street) }}" 
                               class="w-full p-2 border border-gray-300 rounded-lg @error('street') border-red-500 @enderror">
                        
                    </div>
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 mb-2">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $address->city) }}" 
                               class="w-full p-2 border border-gray-300 rounded-lg @error('city') border-red-500 @enderror">
                        
                    </div>
                    <div class="mb-4">
                        <label for="zipcode" class="block text-gray-700 mb-2">Zip Code</label>
                        <input type="text" name="zipcode" id="zip_code" value="{{ old('zipcode', $address->zipcode) }}" 
                               class="w-full p-2 border border-gray-300 rounded-lg @error('zipcode') border-red-500 @enderror">
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('account.profile') }}" class="text-gray-600 hover:underline">Cancel</a>
                    <button type="submit" class="bg-violet-800 text-white px-4 py-2 rounded-lg hover:bg-violet-700">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>