@extends('app.layout')
@section('content')



<main></main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta charset="UTF-8">
<script src="https://cdn.tailwindcss.com"></script>
<section class="min-h-screen flex items-center justify-center" style="background-color: #faad28;">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Create an Account</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('register') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-user"></i> Name</label>
                <input type="text" name="name" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="text" name="phone" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-venus-mars"></i> Gender</label>
                <select name="gender" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-image"></i> Profile Picture</label>
                <input type="file" name="profile_picture" accept="image/*"
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400">
                <p class="text-xs text-gray-500 mt-1">Optional: Upload a profile picture</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700"><i class="fas fa-map-marker-alt"></i> Address</label>
                <textarea name="address" rows="3"
                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400"></textarea>
            </div>

            <button type="submit"
                class="w-full" style="background-color: #fa7f28; color: #fff; padding: 0.5rem 1rem; border-radius: 0.5rem; transition: background 0.2s;"
                onmouseover="this.style.backgroundColor='#fa8f28'" onmouseout="this.style.backgroundColor='#fa7f28'">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="text-orange-600 hover:underline">Login here</a>
        </p>
    </div>
</section>
@endsection
