
@extends('app.adminlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin Control – Edit Priest</h1>
    <p class="mb-4">Administrators can edit or update priest records to keep the database consistent and error-free.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Edit Priest</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.priests.update', $priest->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $priest->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $priest->age) }}" required>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" step="0.1" class="form-control" id="rating" name="rating" value="{{ old('rating', $priest->rating) }}" required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">

                    @if($priest->image)
                        <small class="text-muted">Current: {{ $priest->image }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $priest->phone) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $priest->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="gotra">Gotra</label>
                    <input type="text" class="form-control" id="gotra" name="gotra" value="{{ old('gotra', $priest->gotra) }}" required>
                </div>

                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" class="form-control" id="specialization" name="specialization" value="{{ old('specialization', $priest->specialization) }}" required>
                </div>

                <div class="form-group">
                    <label for="experience_years">Experience (Years)</label>
                    <input type="number" class="form-control" id="experience_years" name="experience_years" value="{{ old('experience_years', $priest->experience_years) }}" required>
                </div>

                <div class="form-group">
                    <label for="availability">Availability</label>
                    <input type="text" class="form-control" id="availability" name="availability" value="{{ old('availability', $priest->availability) }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $priest->address) }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">Update Priest</button>
                <a href="{{ route('admin.priests') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

</div>
@endsection
