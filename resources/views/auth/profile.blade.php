@extends('app.layout')
@section('content')

<main></main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta charset="UTF-8">
<script src="https://cdn.tailwindcss.com"></script>

<section class="min-h-screen flex items-center justify-center" style="background-color: #faad28;">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <div class="flex flex-col items-center mb-6">
            <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-orange-400 mb-3">
                <img src="{{ Auth::user()->photo ?? asset('images/default-profile.png') }}" alt="Profile Photo" class="object-cover w-full h-full">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
            <p class="text-gray-500"><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center">
                <i class="fas fa-user text-orange-500 mr-3"></i>
                <span class="font-medium text-gray-700">Full Name:</span>
                <span class="ml-2 text-gray-800">{{ Auth::user()->name }}</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-envelope text-orange-500 mr-3"></i>
                <span class="font-medium text-gray-700">Email:</span>
                <span class="ml-2 text-gray-800">{{ Auth::user()->email }}</span>
            </div>
            @if(Auth::user()->phone)
            <div class="flex items-center">
                <i class="fas fa-phone text-orange-500 mr-3"></i>
                <span class="font-medium text-gray-700">Phone:</span>
                <span class="ml-2 text-gray-800">{{ Auth::user()->phone }}</span>
            </div>
            @endif
            @if(Auth::user()->gender)
            <div class="flex items-center">
                <i class="fas fa-venus-mars text-orange-500 mr-3"></i>
                <span class="font-medium text-gray-700">Gender:</span>
                <span class="ml-2 text-gray-800">{{ Auth::user()->gender }}</span>
            </div>
            @endif
            <!-- Add more fields as needed -->
        </div>

        <div class="mt-6 flex justify-between">
            {{-- <a href="{{ route('profile.edit') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">Edit Profile</a> --}}
            <a href="{{ route('logout') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden ">
                @csrf
            </form>
            <a href="{{ route('edit.profile') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">Edit Profile</a>

        </div>
    </div>
</section>
@endsection
