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

        <form method="POST" action="{{ route('password.change') }}" class="space-y-5">
            @csrf

            @if(session('status'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-2">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-2">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="current_password">
                    <i class="fas fa-lock mr-2 text-orange-500"></i>Current Password
                </label>
                <input type="password" name="current_password" id="current_password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="new_password">
                    <i class="fas fa-key mr-2 text-orange-500"></i>New Password
                </label>
                <input type="password" name="new_password" id="new_password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="new_password_confirmation">
                    <i class="fas fa-key mr-2 text-orange-500"></i>Confirm New Password
                </label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('profile') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">Cancel</a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">Change Password</button>
            </div>
        </form>
    </div>
</section>
@endsection
