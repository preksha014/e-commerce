<!-- profile-information.blade.php -->
@extends('user.account-page')

@section('account-content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Customer Profile</h2>
            <a href="{{ route('account.profile.edit') }}" class="text-violet-600 hover:text-violet-700 transition-colors duration-200 flex items-center gap-2">
                <span>✏️</span>
                <span>Edit Profile</span>
            </a>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Full Name</h3>
                    <p class="text-gray-900">{{ auth()->guard('customer')->user()->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Email Address</h3>
                    <p class="text-gray-900">{{ auth()->guard('customer')->user()->email }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <h3 class="text-sm font-medium text-gray-500 mb-3">Shipping Address</h3>
                @if(auth()->guard('customer')->user()->address->isNotEmpty())
                    @foreach(auth()->guard('customer')->user()->address as $address)
                        <p class="text-gray-900">{{ $address->street }},<br>{{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</p>
                    @endforeach
                @else
                    <p class="text-gray-500 italic">No address available</p>
                @endif
            </div>
        </div>
    </div>
@endsection