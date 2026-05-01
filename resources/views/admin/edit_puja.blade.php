@extends('app.adminlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin Control – Edit Puja</h1>
    <p class="mb-4">Administrators can edit or update puja records to keep the database consistent and error-free.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Edit Puja</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pujas.update', $puja->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $puja->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $puja->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', $puja->price) }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @if($puja->image)
                        <small class="text-muted">Current: {{ $puja->image }}</small>
                    @endif
                </div>
                <button type="submit" class="btn btn-warning">Update Puja</button>
                <a href="{{ route('admin.pujas') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

</div>
@endsection
