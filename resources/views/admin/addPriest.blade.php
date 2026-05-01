@extends('app.adminlayout')

@section('content')
<div class="container mt-5">
    <h2>Add New Priest</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.addpriest.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Priest Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" >
            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" >
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="gotra" class="form-label">Gotra</label>
            <input type="text" class="form-control" id="gotra" name="gotra">
            @error('gotra') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <textarea class="form-control" id="specialization" name="specialization" rows="2"></textarea>
            @error('specialization') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="experience_years" class="form-label">Experience (Years)</label>
            <input type="number" class="form-control" id="experience_years" name="experience_years" required>
            @error('experience_years') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" step="0.1" min="0" max="5" required>
            @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="availability" class="form-label">Availability</label>
           <select class="form-control" id="availability" name="availability">
                <option value="">Select Availability</option>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>

            @error('availability') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Priest Image</label>
            <input class="form-control" type="file" id="image" name="image">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Priest</button>
    </form>
</div>
@endsection
