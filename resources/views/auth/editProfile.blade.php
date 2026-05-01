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
                <img id="profile-photo-preview" src="{{ Auth::user()->photo ?? asset('images/default-profile.png') }}" alt="Profile Photo" class="object-cover w-full h-full">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Profile</h2>
        </div>

        <form action="{{ route('edit.profile.post') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            {{-- @method('PUT') --}}

            <div>

                <label class="block font-medium text-gray-700 mb-1" for="photo"><i class="fas fa-image text-orange-500 mr-2"></i>Profile Photo</label>
                <input type="file" name="photo" id="photo"  accept="image/*" class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('photo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1" for="name"><i class="fas fa-user text-orange-500 mr-2"></i>Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1" for="email"><i class="fas fa-envelope text-orange-500 mr-2"></i>Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1" for="phone"><i class="fas fa-phone text-orange-500 mr-2"></i>Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}" class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1" for="gender">
                    <i class="fas fa-venus-mars text-orange-500 mr-2"></i>Gender
                </label>
                <select name="gender" id="gender" class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="" {{ old('gender', Auth::user()->gender) == '' ? 'selected' : '' }}>Select Gender</option>
                    <option value="male" {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', Auth::user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-start">
                <a href="{{ route('password.change') }}" class="text-orange-500 hover:underline text-sm font-medium">
                    Change Password
                </a>
            </div>

            <!-- Add more fields as needed -->

            <div class="flex justify-between mt-6">
                <a href="{{ route('profile') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">Cancel</a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">Save Changes</button>
            </div>
        </form>
    </div>
</section>

<script>
    document.getElementById('photo').addEventListener('change', function(e) {
        const [file] = e.target.files;
        if (file) {
            document.getElementById('profile-photo-preview').src = URL.createObjectURL(file);
        }
    });
</script>
@endsection
